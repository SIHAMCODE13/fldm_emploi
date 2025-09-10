<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class DeclarationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $message;
    public $declarationId;
    public $type;

    public function __construct($message, $declarationId, $type = 'info')
    {
        $this->message = $message;
        $this->declarationId = $declarationId;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        // Utiliser uniquement la base de données, pas d'email
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'declaration_id' => $this->declarationId,
            'type' => $this->type,
            'time' => now()->toDateTimeString(),
            'url' => route('admin.declarations'), // Correction ici
        ];
    }
}