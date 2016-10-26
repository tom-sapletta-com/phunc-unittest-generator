<?php

/**
 * Project: phunc-unittest-generator,
 * File created by: tom-sapletta-com, on 26.10.2016, 19:00
 */
class FindTextInFile
{
    public function __construct($file_list)
    {
        $entry = str_replace('.php', '', $entry);
        $needle = ['interface', 'abstract'];
//        $is_find = $this->find_in_file($needle, $filepath);
        $is_find = (string) new SearchingFile($needle, $filepath);
        if ($is_find) {
            $this->files_excluded[] = $files_prefix . $entry;
        } else {
            $this->files[] = $files_prefix . $entry;
        }
    }

}