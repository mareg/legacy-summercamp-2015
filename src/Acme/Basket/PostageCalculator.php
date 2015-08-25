<?php

namespace Acme\Basket;

use Acme\Postage\PostageRepository;
use Acme\Postage\Postage;

class PostageCalculator
{
    private $postageRepository;

    public function __construct(PostageRepository $postageRepository)
    {
        $this->postageRepository = $postageRepository;
    }

    public function calculateForBasket(array $basket = [])
    {
        $qty = array_sum($basket);

        if ($qty === 0) {
            return Postage::withQuantityAndPrice(0, 0);
        }

        return $this->postageRepository->findPostageForQuantity($qty);
    }
}
