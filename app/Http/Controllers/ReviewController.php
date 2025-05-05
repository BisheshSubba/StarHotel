<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $roomId)
    {
        $request->validate([
            'review' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = new Review();
        $review->room_id = $roomId;
        $review->user_id = Auth::id();
        $review->review = $request->input('review');
        $review->rating = $request->input('rating');
        $review->save();

        return redirect()->back()->with('success', 'Review added successfully!');
    }

    public function showReviews($roomId)
    {
        $room = Room::with('reviews.user')->findOrFail($roomId);
        return view('room_details', compact('room'));
    }
    public function destroy($id)
{
    $review = Review::findOrFail($id);

    if (Auth::id() == $review->user_id) {
        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully!');
    }

    return redirect()->back()->with('error', 'You are not authorized to delete this review.');
}

}
