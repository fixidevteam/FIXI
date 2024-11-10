<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;

class UserNotification extends Notification
{
    protected $papier;
    protected $daysRemaining;

    public function __construct($papier, $daysRemaining)
    {
        $this->papier = $papier;
        $this->daysRemaining = $daysRemaining;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Document \"{$this->papier->type}\" will expire in {$this->daysRemaining} days.",
            'papier_id' => $this->papier->id,
        ];
    }
}
