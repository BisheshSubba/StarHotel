<?php
namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RecommendationController extends Controller
{
    public function recommend($roomId)
    {
        $rooms = Room::all();
        
        $roomData = $rooms->map(function ($room) {
            return [
                'id' => (int) $room->id,
                'wifi' => $room->wifi ? 1 : 0,
                'bed_type' => ($room->bed_type == 'double') ? 1 : 0,
                'rating' => $room->average_rating ?? 3.0,
                'room_type' => $this->encodeRoomType($room->room_type),
                'room_view' => $this->encodeRoomView($room->room_view),
                'breakfast' => $room->breakfast ? 1 : 0,
            ];
        });

        if ($roomData->isEmpty()) {
            Log::error("No rooms found in the database.");
            return response()->json(['error' => 'No rooms found in the database.'], 404);
        }

        $pythonScript = storage_path('app/python/recommend.py');
        $jsonInput = json_encode($roomData);
        $command = "python " . escapeshellarg($pythonScript) . " " . escapeshellarg($jsonInput) . " " . escapeshellarg($roomId);
    
        Log::info("Python Command: " . $command);
        
        $output = shell_exec($command);

        if ($output === null) {
            Log::error("Python script did not return any output.");
            return response()->json(['message' => 'Python script error. No output received.'], 500);
        }
    
        Log::info("Python Output: " . $output);
    
        $recommendedRoomIds = json_decode($output, true);
   
        if (!is_array($recommendedRoomIds) || empty($recommendedRoomIds)) {
            Log::error("Invalid or empty recommendedRoomIds: " . json_encode($recommendedRoomIds));
            return view('recommendations', ['recommendedRooms' => collect([])]); 
        }

        $recommendedRooms = Room::whereIn('id', $recommendedRoomIds)->get();
    
        if ($recommendedRooms->isEmpty()) {
            Log::warning("No matching rooms found in the database for recommended IDs: " . json_encode($recommendedRoomIds));
        }
    
        return  $recommendedRooms;
    }

    private function encodeRoomType($type)
    {
        $mapping = ['standard' => 0, 'delux' => 1, 'superdelux' => 2];
        return $mapping[strtolower($type)] ?? 0; 
    }

    private function encodeRoomView($view)
    {
        $mapping = ['garden view' => 0, 'mountain view' => 1, 'city view' => 2];
        return $mapping[strtolower($view)] ?? 0; 
    }
}
