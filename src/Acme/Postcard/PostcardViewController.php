<?php

namespace Acme\Postcard;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostcardViewController
{
    /**
     * @var PostcardRepository $postcardRepository
     */
    private $postcardRepository;

    /**
     * @var \Twig_Environment $twigRenderer
     */
    private $twigRenderer;

    /**
     * @param PostcardRepository $postcardRepository
     * @param \Twig_Environment  $twigRenderer
     */
    public function __construct(
        PostcardRepository $postcardRepository,
        \Twig_Environment $twigRenderer
    ) {
        $this->postcardRepository = $postcardRepository;
        $this->twigRenderer = $twigRenderer;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function productViewAction(Request $request)
    {
        $id = $request->query->get('id');

        $postcard = $this->postcardRepository->findById($id);

        $view = $this->twigRenderer->render('postcard/view.twig.html', ['postcard' => $postcard->toView()]);

        return new Response(
            $view,
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
    }
}
