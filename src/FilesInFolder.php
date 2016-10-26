<?php

/**
 * Project: unittest-generator,
 * File created by: tom-sapletta-com, on 24.10.2016, 08:28
 */
class FilesInFolder
{
    public function __construct($folder, $filter)
    {
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
                        $this->files[] = $entry;
                        $this->scanned++;
                    } else {
                        $this->folders[] = $entry;
                    }
                }
            }
            closedir($handle);
        }
    }
}