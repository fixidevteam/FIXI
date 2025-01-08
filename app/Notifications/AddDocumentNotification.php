<?php

namespace App\Notifications;


use Illuminate\Notifications\Notification;

class AddDocumentNotification extends Notification
{
    private $document;
    private $message;
    private $uniqueKey;
    private $isCar;

    public function __construct($document, $message, $uniqueKey, $isCar)
    {
        $this->document = $document;
        $this->message = $message;
        $this->uniqueKey = $uniqueKey;
        $this->isCar = $isCar;
    }
    public function via($notifiable)
    {
        // Use database channel for notifications
        return ['database'];
    }
    public function toDatabase($notifiable)
    {
        return [
            'unique_key' => $this->uniqueKey,
            'document_id' => $this->document->id,
            'type' => $this->document->type,
            'message' => $this->message,
            'is_car_document' => $this->isCar,
            'car_id' => $this->isCar ? $this->document->voiture_id : null,
        ];
    }
}