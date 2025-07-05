<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class StockAlertNotification extends Notification
{
    public $item;
    public $type;
    public $currentStock;

    public function __construct($item, $type)
    {
        $this->item = $item;
        $this->type = $type;

// Calculate total stock manually
        $this->currentStock = $item->batches->sum('quantity_remaining');
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => "Low stock alert for {$this->type}",
            'message' => "{$this->item->name} is at {$this->currentStock} (min: {$this->item->minimum_stock_alert})",
            'type' => $this->type,
            'stock' => $this->currentStock,
            'minimum' => $this->item->minimum_stock_alert,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }
}
