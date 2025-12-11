<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class CartJson extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (int)$this->pivot->id,
            'product_id' => (int)$this->pivot->product_id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'price' => (int)$this->price
        ];
    }
}
