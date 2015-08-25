<?php

namespace spec\Acme\Postcard;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Acme\Postcard\PostcardRepository;
use Symfony\Component\HttpFoundation\Response;
use Acme\Postcard\Postcard;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class PostcardViewControllerSpec extends ObjectBehavior
{
    function let(PostcardRepository $postcardRepository, \Twig_Environment $twigRenderer)
    {
        $this->beConstructedWith($postcardRepository, $twigRenderer);
    }

    function it_returns_Response(
        PostcardRepository $postcardRepository,
        \Twig_Environment $twigRenderer,
        Request $request,
        ParameterBagInterface $query
    ) {
        $query->get('id')->willReturn(4);

        $request->query = $query;

        $postcardRepository->findById(4)->willReturn(Postcard::fromArray([
                'id' => 7,
                'title' => 'Royal Jordanian Airbus A310',
                'filename' => '007.jpg',
                'price' => 5.95,
                'airline' => 'Royal Jordanian',
                'make' => 'Airbus A310'
            ]));

        $twigRenderer->render('postcard/view.twig.html', ['postcard' =>
            [
                'id' => 7,
                'title' => 'Royal Jordanian Airbus A310',
                'filename' => '007.jpg',
                'price' => '5.95',
                'airline' => 'Royal Jordanian',
                'make' => 'Airbus A310'
            ]
        ])->shouldBeCalled();

        $this->productViewAction($request)->shouldBeAnInstanceOf(Response::class);
    }
}
