<?php

/**
 * Project: unittest-generator,
 * File created by: tom-sapletta-com, on 24.10.2016, 08:28
 */
class SearchingTextinFiles
{
    public function __construct(array $file_list)
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