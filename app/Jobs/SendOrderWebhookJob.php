<?php

namespace App\Jobs;

use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendOrderWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $orderId)
    {
    }

    public function handle(): void
    {
        $url = config('services.order_webhook.url');

        if (blank($url)) {
            return;
        }

        $order = Order::with([
            'creator',
            'updator',
            'order_details.product.category',
        ])->find($this->orderId);

        if (! $order) {
            return;
        }

        Http::acceptJson()
            ->asJson()
            ->timeout((int) config('services.order_webhook.timeout', 10))
            ->post($url, (new OrderResource($order))->resolve());
    }
}