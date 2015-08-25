<?php

namespace Acme\Basket;

use Acme\Postcard\PostcardRepository;

class BasketView
{
    /**
     * @var PostageCalculator $postageCalculatr
     */
    private $postageCalculatr;

    /**
     * @var PostcardRepository $postcardRepository
     */
    private $postcardRepository;

    /**
     * @param PostageCalculator  $postageCalculator
     * @param PostcardRepository $postcardRepository
     */
    public function __construct(
        PostageCalculator $postageCalculator,
        PostcardRepository $postcardRepository
    ) {
        $this->postageCalculatr = $postageCalculator;
        $this->postcardRepository = $postcardRepository;
    }

    /**
     * @param array $basket
     *
     * @return mixed
     */
    public function toView(array $basket = [])
    {
        $itemsValue = 0;
        $itemsCount = array_sum($basket);
        $items = [];
        foreach ($basket as $id => $qty) {
            if ($postcard = $this->postcardRepository->findById($id)) {
                $itemsValue += $postcard->price() * $qty;
                $items[] = [
                    'postcard' => $postcard->toView(),
                    'quantity' => sprintf("%d", $qty),
                    'value' => sprintf("%1.02f", $qty * $postcard->price())
                ];
            }
        }

        $postage = $this->postageCalculatr->calculateForBasket($basket);

        return [
            'total_value' => sprintf("%1.02f", $itemsValue + $postage->price()),
            'items_value' => sprintf("%1.02f", $itemsValue),
            'items_count' => sprintf("%d", $itemsCount),
            'items' => $items,
            'postage' => $postage->toView()
        ];
    }
}
