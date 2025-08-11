<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportResolvedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Report Has Been Resolved')
            ->line('Your report has been marked as resolved.')
            ->line('Report Category: ' . $this->report->category->name)
            ->line('Location: ' . $this->report->street . ', ' . $this->report->barangay)
            ->action('View Report', route('reports.show', $this->report))
            ->line('Thank you for helping improve our community!');
    }

    public function toArray($notifiable)
    {
        return [
            'report_id' => $this->report->id,
            'category' => $this->report->category->name,
            'message' => 'Your report has been marked as resolved.',
            'action_url' => route('reports.show', $this->report)
        ];
    }
}
