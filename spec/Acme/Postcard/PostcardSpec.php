<?php

namespace spec\Acme\Postcard;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostcardSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('fromArray', [
            [
                'id' => 7,
                'title' => 'Royal Jordanian Airbus A310',
                'filename' => '007.jpg',
                'price' => 5.95,
                'airline' => 'Royal Jordanian',
                'make' => 'Airbus A310'
            ]
        ]);
    }

    function it_has_id()
    {
        $this->id()->shouldReturn(7);
    }

    function it_has_price()
    {
        $this->price()->shouldReturn(5.95);
    }

    function it_returns_data_bag_for_view()
    {
        $this->toView()->shouldReturn(
            [
                'id' => 7,
                'title' => 'Royal Jordanian Airbus A310',
                'filename' => '007.jpg',
                'price' => '5.95',
                'airline' => 'Royal Jordanian',
                'make' => 'Airbus A310'
            ]
        );
    }
}
