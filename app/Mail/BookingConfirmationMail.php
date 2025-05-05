<?php
namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $roomName;

    public function __construct(Booking $booking, $roomName)
    {
        $this->booking = $booking;
        $this->roomName = $roomName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Booking is Confirmed!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_confirmation',
            with: [
                'name' => $this->booking->name,
                'room_name' => $this->roomName, 
                'total_guest' => $this->booking->total_occupancy, 
                'start_date' => $this->booking->start_date,
                'end_date' => $this->booking->end_date,
                'amount' => $this->booking->total_amount,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
