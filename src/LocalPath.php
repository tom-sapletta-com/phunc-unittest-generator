<?php

/**
 * Project: phunc-unittest-generator,
 * File created by: tom-sapletta-com, on 26.10.2016, 19:05
 */
class LocalPath implements Path
{
    public $path;

    /**
     * @return LocalPath
     */
    public function path()
    {
        return $this->path;
    }
}