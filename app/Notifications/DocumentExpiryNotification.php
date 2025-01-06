<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocumentExpiryNotification extends Notification
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
        return ['database','mail'];
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
    public function toMail($notifiable)
    {
        $url = $this->isCar
            ? route('paiperVoiture.show', $this->document->id)
            : route('paiperPersonnel.show', $this->document->id);

        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Notification de document expiré')
            ->view('emails.notifications', [
                'title' => 'Notification de document expiré',
                'user' => $notifiable,
                'body' => $this->message,
                'actionText' => 'Voir le document',
                'actionUrl' => $url,
            ]);
    }
}