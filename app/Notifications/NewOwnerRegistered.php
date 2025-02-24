<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOwnerRegistered extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        return (new MailMessage)
                    ->subject('New Owner Registration')
                    ->line('A new owner has registered:')
                    ->line('Name: ' . $this->user->fname . ' ' . $this->user->lname)
                    ->line('Email: ' . $this->user->email)
                    ->action('Review Registration', route('admin.approvals.index'))
                    ->line('Please review and approve the registration.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'New owner registration from ' . $this->user->fname . ' ' . $this->user->lname,
            'url' => route('admin.approvals.index')
        ];
    }
}
