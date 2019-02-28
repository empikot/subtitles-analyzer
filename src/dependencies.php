<?php

$container = new \Slim\Container(require __DIR__ . '/../src/settings.php');

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig($container['settings']['renderer']['template_path'], [
        'cache' => false,
    ]);

    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));
    return $view;
};
(new \Analyzer\ServiceProviders\SubtitleFile\AnalyzerServiceProvider())->register($container);
(new \Analyzer\ServiceProviders\UploadedFile\HandlerServiceProvider())->register($container);
(new \Analyzer\ServiceProviders\WordsSorterServiceProvider())->register($container);

return $container;
