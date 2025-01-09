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
        return ['database', 'mail'];
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
    // public function toMail($notifiable)
    // {
    //     $url = $this->isCar
    //         ? route('paiperVoiture.show', $this->document->id)
    //         : route('paiperPersonnel.show', $this->document->id);

    //     return (new \Illuminate\Notifications\Messages\MailMessage)
    //         ->subject('Notification de document expiré')
    //         ->view('emails.notifications', [
    //             'title' => 'Notification de document expiré',
    //             'user' => $notifiable,
    //             'body' => $this->message,
    //             'actionText' => 'Voir le document',
    //             'actionUrl' => $url,
    //         ]);
    // }
    public function toMail($notifiable)
    {
        // Calculate the days remaining until expiration
        $daysRemaining = $this->calculateDaysRemaining();

        if ($daysRemaining === 0) {
            $alertMessage = "Expire aujourd'hui";
        } elseif ($daysRemaining > 0 && $daysRemaining <= 7) {
            $alertMessage = "Le document expire dans {$daysRemaining} jours";
        } elseif ($daysRemaining < 0) {
            $alertMessage = "Le document est expiré depuis " . abs($daysRemaining) . " jours";
        } else {
            return; // Skip sending the notification if no alert is needed
        }
        $url = $this->isCar
            ? route('paiperVoiture.show', $this->document->id)
            : route('paiperPersonnel.show', $this->document->id);

        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('⚠️ ' . $alertMessage . ' - ' . $this->document->type . ' nécessite votre attention')
            ->view('emails.notifications', [
                'title' => '⚠️ ' . $this->document->type . ' nécessite votre attention',
                'user' => $notifiable,
                'alertMessage' => $alertMessage,
                'document' => $this->document, // Pass the document variable here
                'actionText' => 'Voir le document',
                'actionUrl' => $url,
            ]);
    }
    protected function calculateDaysRemaining()
    {
        // Ensure the document has a valid expiration date
        if (!$this->document->date_fin) {
            return null; // No expiration date defined
        }

        // Calculate the difference in days between the current date and the expiration date
        $expirationDate = \Carbon\Carbon::parse($this->document->date_fin);
        $currentDate = \Carbon\Carbon::now();

        return $currentDate->diffInDays($expirationDate, false); // Use `false` for signed difference
    }
}