<?php

namespace spec\Acme\Basket;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Acme\Postage\Postage;
use Acme\Postage\PostageRepository;

class PostageCalculatorSpec extends ObjectBehavior
{
    function let(PostageRepository $postageRepository)
    {
        $this->beConstructedWith($postageRepository);
    }

    function it_calculates_no_postage_for_empty_basket(PostageRepository $postageRepository)
    {
        $postageRepository->findPostageForQuantity(0)->shouldNotBeCalled();

        $this->calculateForBasket([])->shouldBeLike(Postage::withQuantityAndPrice(0, 0));
    }

    function it_calculates_flat_postage_for_any_single_item(PostageRepository $postageRepository)
    {
        $postage = Postage::withQuantityAndPrice(1, 1.95);

        $postageRepository->findPostageForQuantity(1)->willReturn($postage);

        $this->calculateForBasket(['1' => 1])->shouldReturn($postage);
        $this->calculateForBasket(['5' => 1])->shouldReturn($postage);
    }

    function it_calculates_flat_postage_for_two_items(PostageRepository $postageRepository)
    {
        $postage = Postage::withQuantityAndPrice(2, 2.95);

        $postageRepository->findPostageForQuantity(2)->willReturn($postage);

        $this->calculateForBasket(['1' => 2])->shouldReturn($postage);
        $this->calculateForBasket(['5' => 1, '6' => 1])->shouldReturn($postage);
    }
}
