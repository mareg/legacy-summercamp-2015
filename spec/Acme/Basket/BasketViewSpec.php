<?php

namespace spec\Acme\Basket;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Acme\Basket\PostageCalculator;
use Acme\Postcard\PostcardRepository;
use Acme\Postage\Postage;
use Acme\Postcard\Postcard;

class BasketViewSpec extends ObjectBehavior
{
    function let(
        PostageCalculator $postageCalculator,
        PostcardRepository $postcardRepository
    ) {
        $this->beConstructedWith($postageCalculator, $postcardRepository);
    }

    function it_returns_a_view_data_bag_for_given_session_basket(
        PostageCalculator $postageCalculator,
        PostcardRepository $postcardRepository
    ) {
        $postageCalculator->calculateForBasket(['1' => 1])->willReturn(Postage::withQuantityAndPrice(1, 1.95));

        $postcardRepository->findById('1')->willReturn(Postcard::fromArray([
                'id' => 1,
                'title' => 'Royal Jordanian Airbus A310',
                'filename' => '007.jpg',
                'price' => 5.95,
                'airline' => 'Royal Jordanian',
                'make' => 'Airbus A310'
            ]));

        $this->toView(['1' => 1])->shouldBeLike([
            'total_value' => '7.90',
            'items_value' => '5.95',
            'items_count' => '1',
            'items' => [
                [
                    'postcard' => [
                        'id' => 1,
                        'title' => 'Royal Jordanian Airbus A310',
                        'filename' => '007.jpg',
                        'price' => '5.95',
                        'airline' => 'Royal Jordanian',
                        'make' => 'Airbus A310'
                    ],
                    'quantity' => '1',
                    'value' => '5.95'
                ]
            ],
            'postage' => [
                'quantity' => '1',
                'price' => '1.95'
            ]
        ]);
    }
}
