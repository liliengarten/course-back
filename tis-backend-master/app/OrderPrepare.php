<?php

namespace App;

class OrderPrepare
{
    public int $id;
    public array $productIds;
    public int $orderPrice;

    /**
     * @param int $id
     */
    public function __construct(int $id, $products)
    {
        $this->id = $id;
        $this->productIds = $products->pluck('id')->toArray();
        $this->orderPrice = $products->pluck('price')->sum();
    }


}
