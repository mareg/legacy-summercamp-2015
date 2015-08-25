<?php

require __DIR__ . '/../_inc/container.php';

use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$response = $container->get('acme.postcard_view.controller')->productViewAction($request);

$response->send();
