<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $title;
    protected $message;
    protected $type;

    public function __construct($title, $message, $type)
    {
        $this->title = $title;
        $this->message = $message;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->title)
            ->line($this->message)
            ->action('View Booking', url('/bookings'))
            ->line('Thank you for using our service!');
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'type' => $this->type,
        ];
    }
} 