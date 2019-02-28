<?php
namespace Analyzer\Controllers;

use Interop\Container\ContainerInterface;

class BaseController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * BaseController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
