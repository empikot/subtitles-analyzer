<?php

namespace Analyzer\Models;

class SubtitleFileInfo
{
    /**
     * @var string
     */
    private $pathToFile;
    /**
     * @var string
     */
    private $basename;
    /**
     * @var string
     */
    private $extension;

    /**
     * SubtitleFileInfo constructor.
     * @param string $pathToFile
     * @param string $basename
     * @param string $extension
     */
    public function __construct(string $pathToFile, string $basename, string $extension)
    {
        $this->pathToFile = $pathToFile;
        $this->basename = $basename;
        $this->extension = $extension;
    }

    /**
     * @return string
     */
    public function getPathToFile(): string
    {
        return $this->pathToFile;
    }

    /**
     * @return string
     */
    public function getBasename(): string
    {
        return $this->basename;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }
}
