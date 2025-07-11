<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\RawMaterial;
use App\Models\User;
use App\Notifications\StockAlertNotification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class CheckStockLevels extends Command
{
    protected $signature = 'stock:check';
    protected $description = 'Check stock and send alerts';

    public function handle()
    {
        $users = User::all();

        $this->checkStock('product', $users);
        $this->checkStock('raw_material', $users);

        $this->info('Stock check complete');
    }

    private function checkStock($type, $users)
    {
        if ($type === 'product') {
            $items = \App\Models\Product::with('batches')->get();
        } else {
            $items = \App\Models\RawMaterial::with('batches')->get();
        }

        foreach ($items as $item) {
            $totalRemaining = $item->batches->sum('quantity_remaining');
            $minimum = $item->minimum_stock_alert;

            if ($totalRemaining <= $minimum) {
                foreach ($users as $user) {
                    $user->notify(new StockAlertNotification($item, $type));

                    if ($user->fcm_token) {
                        $this->sendPush($user->fcm_token, 'Stock Alert', "{$item->name} is low in stock!");
                    }
                }
            }
        }
    }

    private function sendPush($token, $title, $body)
    {
        $messaging = app('firebase.messaging');

        $message = CloudMessage::withTarget('token', $token)
            ->withNotification(FirebaseNotification::create($title, $body));

        $messaging->send($message);
    }
}
