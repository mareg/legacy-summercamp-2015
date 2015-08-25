<?php

namespace spec\Acme\Postage;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostageSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('withQuantityAndPrice', [1, 2.95]);
    }

    function it_returns_data_bag_for_view()
    {
        $this->toView()->shouldReturn(['quantity' => '1', 'price' => '2.95']);
    }

    function it_has_price()
    {
        $this->price()->shouldReturn(2.95);
    }
}
