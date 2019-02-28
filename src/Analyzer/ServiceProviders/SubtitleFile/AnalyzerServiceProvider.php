<?php
namespace Analyzer\ServiceProviders\SubtitleFile;

use Analyzer\Services\SubtitleFile\Analyzer;
use Analyzer\Services\SubtitleFile\Parser;
use Analyzer\Services\SubtitleFile\Reader;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class AnalyzerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['subtitleFileAnalyzer'] = function ($container) {
            return new Analyzer(
                new Parser(
                    new Reader()
                )
            );
        };
    }
}
