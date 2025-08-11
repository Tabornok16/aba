<?php

namespace App\Notifications;

use App\Models\Rank;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RankUpNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $rank;

    public function __construct(Rank $rank)
    {
        $this->rank = $rank;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Congratulations on Your New Rank!')
            ->line('You\'ve achieved the rank of ' . $this->rank->name . '!')
            ->line($this->rank->description)
            ->action('View Your Profile', route('ranks.index'))
            ->line('Keep contributing to reach even higher ranks!');
    }

    public function toArray($notifiable)
    {
        return [
            'rank_id' => $this->rank->id,
            'rank_name' => $this->rank->name,
            'message' => 'You\'ve achieved the rank of ' . $this->rank->name . '!',
            'action_url' => route('ranks.index')
        ];
    }
}
