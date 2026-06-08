<?php

namespace App\Services;

use App\Jobs\SendOrderWebhookJob;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class OrderSyncService
{
    public function create(array $data, ?int $userId = null): Order
    {
        return DB::transaction(function () use ($data, $userId) {
            $orderData = Arr::get($data, 'order', []);

            $orderData['ref'] = $orderData['ref'] ?? 'BH-' . date('His');
            $orderData['created_by'] = $orderData['created_by'] ?? $userId;
            $orderData['updated_by'] = $orderData['updated_by'] ?? $userId;

            $order = Order::create($orderData);

            foreach (Arr::get($data, 'product_id', []) as $key => $productId) {
                $details = OrderDetail::create([
                    'qty' => Arr::get($data, "qty.{$key}"),
                    'price' => Arr::get($data, "price.{$key}"),
                    'amount' => Arr::get($data, "amount.{$key}"),
                    'product_id' => $productId,
                    'order_id' => $order->id,
                    'created_by' => $userId,
                    'updated_by' => $userId,
                ]);

                if ($details->product) {
                    $details->product->update([
                        'qty' => $details->product->qty - $details->qty,
                    ]);
                }
            }

            $order->load([
                'creator',
                'updator',
                'order_details.product.category',
            ]);

            SendOrderWebhookJob::dispatchAfterResponse($order->id);

            return $order;
        });
    }
}