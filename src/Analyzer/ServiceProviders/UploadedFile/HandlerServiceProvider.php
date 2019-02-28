<?php
namespace Analyzer\ServiceProviders\UploadedFile;

use Analyzer\Services\SubtitleFile\Builder;
use Analyzer\Services\UploadedFile\Handler;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class HandlerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['uploadedFileHandler'] = function ($container) {
            return new Handler(
                new Builder()
            );
        };
    }
}
