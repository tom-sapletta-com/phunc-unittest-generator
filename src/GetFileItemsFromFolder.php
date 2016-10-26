<?php

/**
 * Project: phunc-unittest-generator,
 * File created by: tom-sapletta-com, on 26.10.2016, 19:02
 */
class GetFileItemsFromFolder implements FileItems
{
    public function __construct(LocalPath $folder)
    {
        $folder = $folder->path();
        if ($handle = opendir($folder)) {
            while (false !== ($entry = readdir($handle))) {
                $filepath = $folder . DIRECTORY_SEPARATOR . $entry;
                if ($entry != "." && $entry != "..") {
                    if (is_file($filepath)) {
//                        if ($is_find) {
//                            $this->files_excluded[] = $files_prefix . $entry;
//                        } else {
//                            $this->files[] = $files_prefix . $entry;
//                        }
                        $this->items[] = $entry;
                    } else {
//                        $this->folders[] = $entry;
                    }
                }
            }
            closedir($handle);
        }
    }

//    public $path;
    public $items;

    /**
     * @return LocalPath
     */
//    public function path()
//    {
//        return $this->path;
//    }


    /**
     * @return mixed
     */
    public function items()
    {
        return $this->items;
    }

}