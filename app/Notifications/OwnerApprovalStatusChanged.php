<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OwnerApprovalStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public $isApproved;

    /**
     * Create a new notification instance.
     */
    public function __construct(bool $isApproved)
    {
        $this->isApproved = $isApproved;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        if ($this->isApproved) {
            return (new MailMessage)
                ->subject('Account Approved')
                ->line('Your owner account has been approved.')
                ->line('You can now create listings on our platform.')
                ->action('Create Listing', route('listing.create'));
        }

        return (new MailMessage)
            ->subject('Account Rejected')
            ->line('We regret to inform you that your owner account has been rejected.')
            ->line('Please contact support for more information.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->isApproved 
                ? 'Your owner account has been approved' 
                : 'Your owner account has been rejected',
            'url' => $this->isApproved ? route('listing.create') : route('support')
        ];
    }
}
