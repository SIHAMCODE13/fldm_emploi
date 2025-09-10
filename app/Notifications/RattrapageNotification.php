<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class RattrapageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $message;
    public $rattrapageId;
    public $type;

    public function __construct($message, $rattrapageId, $type = 'info')
    {
        $this->message = $message;
        $this->rattrapageId = $rattrapageId;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
{
    // CORRECTION: URL différente selon le type d'utilisateur
    $url = ($this->type === 'admin') ? route('admin.rattrapages') : route('enseignant.rattrapage.historique');
    
    return [
        'message' => $this->message,
        'rattrapage_id' => $this->rattrapageId, // CORRECTION: utiliser rattrapage_id
        'type' => $this->type,
        'time' => now()->toDateTimeString(),
        'url' => $url,
    ];
}
}