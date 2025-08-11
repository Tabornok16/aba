<?php

namespace App\Notifications;

use App\Models\PublicAdvisory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPublicAdvisoryNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $advisory;

    public function __construct(PublicAdvisory $advisory)
    {
        $this->advisory = $advisory;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Public Advisory: ' . $this->advisory->title)
            ->line('A new public advisory has been posted.')
            ->line($this->advisory->title)
            ->action('View Advisory', route('public-advisories.show', $this->advisory))
            ->line('Stay informed about important updates in our community.');
    }

    public function toArray($notifiable)
    {
        return [
            'advisory_id' => $this->advisory->id,
            'title' => $this->advisory->title,
            'message' => 'New public advisory: ' . $this->advisory->title,
            'action_url' => route('public-advisories.show', $this->advisory)
        ];
    }
}
