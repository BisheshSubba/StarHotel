<div class="review-system-body">
    <h3>Reviews:</h3>
    @foreach($room->reviews as $review)
    <div class="review-container">
        <p class="review-author">
            {{ $review->user ? $review->user->name : 'Deleted User' }}:
        </p>
        <p>{{ $review->review }}</p>
        <p class="review-rating">Rating: {{ $review->rating }}/5</p>

        @auth
            @if(auth()->user()->id == $review->user_id) 
                <form action="{{ route('review.delete', $review->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-review-btn">Delete</button>
                </form>
            @endif
        @endauth
    </div>
@endforeach

    @auth
        <h3>Leave a Review:</h3>
        <form action="{{ route('review.store', $room->id) }}" method="POST" class="review-form">
            @csrf
            <textarea name="review" placeholder="Write your review here" required></textarea>

            <label for="rating">Rating (1 to 5):</label>
            <input type="number" name="rating" id="rating" min="1" max="5" required>

            <button type="submit">Submit</button>
        </form>
    @else
        <p>Please log in to leave a review.</p>
    @endauth
</div>
