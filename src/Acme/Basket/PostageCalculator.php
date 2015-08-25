<?php

namespace Acme\Basket;

use Acme\Postage\PostageRepository;
use Acme\Postage\Postage;

class PostageCalculator
{
    /**
     * @param PostageRepository $postageRepository
     */
    private $postageRepository;

    /**
     * @param PostageRepository $postageRepository
     */
    public function __construct(PostageRepository $postageRepository)
    {
        $this->postageRepository = $postageRepository;
    }

    /**
     * @param array $basket
     *
     * @return Postage
     */
    public function calculateForBasket(array $basket = [])
    {
        $qty = array_sum($basket);

        if ($qty === 0) {
            return Postage::withQuantityAndPrice(0, 0);
        }

        return $this->postageRepository->findPostageForQuantity($qty);
    }
}
