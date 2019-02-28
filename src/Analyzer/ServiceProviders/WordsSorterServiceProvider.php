<?php
namespace Analyzer\ServiceProviders;

use Analyzer\Services\CountedWordsSorter;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class WordsSorterServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['wordsSorter'] = function ($container) {
            return new CountedWordsSorter();
        };
    }
}
