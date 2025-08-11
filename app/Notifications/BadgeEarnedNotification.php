<?php

namespace App\Notifications;

use App\Models\Badge;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BadgeEarnedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $badge;

    public function __construct(Badge $badge)
    {
        $this->badge = $badge;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Congratulations! You\'ve Earned a New Badge')
            ->line('You\'ve earned the ' . $this->badge->name . ' badge!')
            ->line($this->badge->description)
            ->action('View Your Badges', route('badges.index'))
            ->line('Keep up the great work!');
    }

    public function toArray($notifiable)
    {
        return [
            'badge_id' => $this->badge->id,
            'badge_name' => $this->badge->name,
            'message' => 'You\'ve earned the ' . $this->badge->name . ' badge!',
            'action_url' => route('badges.index')
        ];
    }
}
