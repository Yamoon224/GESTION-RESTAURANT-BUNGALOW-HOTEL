<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ref' => $this->ref,
            'amount' => $this->amount,
            'description' => $this->description,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => optional($this->created_at)?->toISOString(),
            'updated_at' => optional($this->updated_at)?->toISOString(),
            'creator' => [
                'id' => optional($this->creator)->id,
                'name' => optional($this->creator)->name,
                'email' => optional($this->creator)->email,
            ],
            'updator' => [
                'id' => optional($this->updator)->id,
                'name' => optional($this->updator)->name,
                'email' => optional($this->updator)->email,
            ],
            'order_details' => OrderDetailResource::collection($this->whenLoaded('order_details')),
        ];
    }
}