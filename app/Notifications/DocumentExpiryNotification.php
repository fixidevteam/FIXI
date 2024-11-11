<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class DocumentExpiryNotification extends Notification
{
    private $document;
    private $message;

    public function __construct($document, $message)
    {
        $this->document = $document;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'document_id' => $this->document->id,
            'type' => $this->document->type,
            'message' => $this->message,
        ];
    }
}
