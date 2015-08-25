<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

require __DIR__ . '/../../vendor/autoload.php';

function buildContainer()
{
    $container = new ContainerBuilder();

    $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../../app/config'));
    $loader->load('services.xml');
    $container->compile();

    return $container;
}

$container = buildContainer();
