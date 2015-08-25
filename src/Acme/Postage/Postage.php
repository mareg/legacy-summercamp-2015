<?php

namespace Acme\Postage;

class Postage
{
    private $quantity;
    private $price;

    public static function withQuantityAndPrice($quantity, $price)
    {
        $postage = new Postage();

        $postage->quantity = $quantity;
        $postage->price = $price;

        return $postage;
    }

    public function toView()
    {
        return [
            'quantity' => sprintf("%1d", $this->quantity),
            'price' => sprintf("%1.02f", $this->price)
        ];
    }

    public function price()
    {
        return $this->price;
    }
}
