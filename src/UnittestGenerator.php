<?php

/**
 * Project: unittest-generator,
 * File created by: tom-sapletta-com, on 22.10.2016, 08:46
 */
class UnittestGenerator
{
    public $files = [];
    public $files_excluded = [];
    public $files_done = [];
    public $folders = [];

    public $created = 0;
    public $scanned = 0;
    public $existing = 0;

    public $folder = '';
    public $folder_test = '';
    public $namespace_project = '';
    public $project_author = '';

    /**
     * UnittestGenerator constructor.
     *
     * @param $folder
     * @param $folder_test
     * @param $namespace_project
     * @param $project_author
     */
    public function __construct($folder, $folder_test, $namespace_project, $project_author)
    {
        $this->folder = $folder;
        $this->folder_test = $folder_test;
        $this->namespace_project = $namespace_project;
        $this->project_author = $project_author;

        // find all files
        $this->folderscan($folder);

        foreach ($this->folders as $subfolder) {
            $files_prefix = $subfolder;
            $this->folderscan($folder . DIRECTORY_SEPARATOR . $subfolder, $files_prefix);
        }
        $this->create_test_files();
        $this->create_summary();
    }

    /**
     * @param $folder
     * @param string $files_prefix
     */
    public function folderscan($folder, $files_prefix = '')
    {
        if ($handle = opendir($folder)) {
            while (false !== ($entry = readdir($handle))) {
                $filepath = $folder . DIRECTORY_SEPARATOR . $entry;
                if ($entry != "." && $entry != "..") {
                    if (is_file($filepath)) {
                        $entry = str_replace('.php', '', $entry);


                        $needle = ['interface', 'abstract'];
                        $is_find = $this->find_in_file($needle, $filepath);
                        if ($is_find) {
                            $this->files_excluded[] = $files_prefix . $entry;
                        } else {
                            $this->files[] = $files_prefix . $entry;
                        }
                        $this->scanned++;
                    } else {
                        $this->folders[] = $entry;
                    }
                }
            }
            closedir($handle);
        }
    }

    /**
     * @param $needle
     * @param $filepath
     * @return mixed
     */
    public function find_in_file($needle, $filepath)
    {
        if (empty($needle)) {
            return false;
        }
        if (!is_array($needle)) {
            $needle = [$needle];
        }
        foreach ($needle as $val) {
            $result = (strpos(file_get_contents($filepath), $val) !== false);
            if ($result) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $namespace
     * @param $project_author
     * @param $date
     * @param $classname
     * @param $classname_test
     * @return string
     */
    public function template($namespace, $project_author, $date, $classname, $classname_test){

        $content = '
<?php

/**
 * Project: ' . $namespace . ',
 * File created by: '.$project_author.', on '. $date .'
 */

require_once __DIR__ . \'../vendor\' . \'/autoload.php\';
use PHPUnit\Framework\TestCase;
use ' . $namespace . ';

/**
 * Test Class ' . $classname_test . '
 * Base Class ' . $classname . '
 */
class ' . $classname_test . ' extends TestCase
{
    public function testTrueIsTrue()
    {
        $object = new ' . $classname . '($param);
        $foo = true;
        $this->assertTrue($foo);
    }
}
';
        return $content;
    }

    /**
     *
     */
    public function create_test_files()
    {

        # create Test file
        foreach ($this->files as $classname) {
            $namespace = '';
            if ($this->namespace_project) {
                $namespace = $this->namespace_project . "\\" . $classname;
            }
            $classname_test = $classname . 'Test';
            $filetest = $this->folder_test . DIRECTORY_SEPARATOR . $classname_test . '.php';

            // create $content from template
            $content = $this->template($namespace, $this->project_author, date("Y-m-d H:i:s"), $classname, $classname_test);

            # if not exist, create it
            if (!is_readable($filetest)) {
                file_put_contents($filetest, $content);
                $this->files_done .= '+ ' . $filetest . "\n";
                $this->created++;
            } else {
                $this->existing++;
            }
        }
    }

    public function create_summary()
    {
        echo 'FILE excluded (interface, abstract):' . count($this->files_excluded) . "\n";
        foreach ($this->files_excluded as $filename) {
            echo '-' . $filename . "\n";
        }
        echo 'FILE scanned:' . $this->scanned . "\n";
        echo 'FILE todo:' . count($this->files) . "\n";
        echo 'FILE existing (not created):' . $this->existing . "\n";
        echo 'FILE TESTS created:' . $this->created . "\n";
        foreach ($this->files_done as $filename) {
            echo '-' . $filename . "\n";
        }
    }
}