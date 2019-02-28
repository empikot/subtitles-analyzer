<?php

namespace tests\Unit\Services\SubtitleFile;

use Analyzer\Services\SubtitleFile\Builder;
use PHPUnit\Framework\TestCase;
use Slim\Http\UploadedFile;

class BuilderTest extends TestCase
{
    /**
     * @test
     */
    public function building_subtitle_file_info()
    {
        // given
        $uploadedFile = new UploadedFile('/path/to/test.tmp', 'originalName.txt');

        // when
        $subtitleFileInfo = (new Builder())->build($uploadedFile);

        // then
        $this->assertEquals('/path/to/test.tmp', $subtitleFileInfo->getPathToFile());
        $this->assertEquals('originalName.txt', $subtitleFileInfo->getBasename());
        $this->assertEquals('txt', $subtitleFileInfo->getExtension());
    }
}
