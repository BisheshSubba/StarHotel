<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Room;
use App\Models\Review;

class UpdateRoomRatings extends Command
{
    protected $signature = 'rooms:update-ratings';
    protected $description = 'Update room ratings based on reviews';

    public function handle()
    {
        $rooms = Room::all();

        foreach ($rooms as $room) {
            // Calculate the average rating for each room
            $averageRating = Review::where('room_id', $room->id)->avg('rating');

            // Update the 'average_rating' column instead of 'rating'
            $room->average_rating = $averageRating ?? 0;

            // Save the updated room
            $room->save();
        }

        $this->info('Room ratings updated successfully.');
    }
}
