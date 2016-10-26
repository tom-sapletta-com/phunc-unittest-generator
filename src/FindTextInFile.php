<?php

/**
 * Project: unittest-generator,
 * File created by: tom-sapletta-com, on 24.10.2016, 08:32
 */
class FindTextInFile implements Searching, Result
{

    public $result = false;

    /*
     * add new Type for
     * ItemsArray
     * FilePath
     *
     */
    /**
     * @param $what
     * @param $where
     * @return bool
     */
    public function searching($what, $where)
    {
        if (empty($what)) {
            return false;
        }
        if (!is_array($what)) {
            $what = [$what];
        }
        foreach ($what as $val) {
            $result = (strpos(file_get_contents($where), $val) !== false);
            if ($result) {
                return true;
            }
        }
        return false;
    }

    public function __construct($what, $where)
    {
        $this->result = $this->searching($what, $where);
    }

    public function result()
    {
        return $this->result;
    }

}