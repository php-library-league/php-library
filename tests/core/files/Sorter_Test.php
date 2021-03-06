<?php
/**
* Sorter
*
* Sortes files to multiple folders
*
* @package      PHP_Library
* @subpackage   Core
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase;
use PHP_Library\Core\Files\Sorter;
use PHP_Library\Core\Files\Directory_Lister;

/**
* Testing Sorter class
*/
class Sorter_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * Parameters for test
    *
    * @var array
    */
    private $params = array();

    /* ---------------------------------------------------------------------- */

    /**
    * Locations for test setup
    *
    * @var array
    */
    protected static $locations = array(
        'folder'          => __DIR__ . '/../../../outsource/',
        'subfolder'       => 'sorter/',
        'destination'     => 'destination/',
        'source'          => 'source/',
        'movable'         => 'movable/',
        'movable_testing' => 'movable_testing/',
        'paths'           => array(),
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Sorter test setup before Setup
    */
    public static function setUpBeforeClass(): void
    {
        self::$locations['paths']['source'] =
            self::$locations['folder'] .
            self::$locations['subfolder'] .
            self::$locations['source'];

        self::$locations['paths']['destination'] =
            self::$locations['folder'] .
            self::$locations['subfolder'] .
            self::$locations['destination'];

        self::$locations['paths']['movable'] =
            self::$locations['folder'] .
            self::$locations['subfolder'] .
            self::$locations['movable'];

        self::$locations['paths']['movable_testing'] =
            self::$locations['folder'] .
            self::$locations['subfolder'] .
            self::$locations['movable_testing'];

        $paths = array(
            self::$locations['paths']['destination'],
            self::$locations['paths']['movable'],
            self::$locations['paths']['movable_testing'],
        );

        foreach ($paths as $path)
        {
            if ( ! file_exists($path))
            {
                mkdir($path);
            }
        }

        $listing = Directory_Lister::listing(array(
            'directory' => self::$locations['paths']['source'],
            'method'    => 'files',
        ));

        foreach ($listing['listing'] as $source)
        {
            copy(
                $source['path'],
                self::$locations['paths']['movable'] . $source['file']
            );

            copy(
                $source['path'],
                self::$locations['paths']['movable_testing'] . $source['file']
            );
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Sorter test setup method
    */
    protected function setUp(): void
    {
        $sorter_folder = __DIR__ . '/../../../outsource/sorter/';

        $this->params['folders']['source']          = $sorter_folder . 'source/';
        $this->params['folders']['destination']     = $sorter_folder . 'destination/';
        $this->params['folders']['movable']         = $sorter_folder . 'movable/';
        $this->params['folders']['movable_testing'] = $sorter_folder . 'movable_testing/';
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Sorter precondition method
    */
    protected function assertPreConditions(): void
    {
        $this->assertDirectoryExists($this->params['folders']['source']);
        $this->assertDirectoryExists($this->params['folders']['destination']);
        $this->assertDirectoryIsReadable($this->params['folders']['source']);
        $this->assertDirectoryIsWritable($this->params['folders']['destination']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test deploy method for existent parameters
    */
    public function test_deploy_method_for_existent_parameters()
    {
        $numbers = array(
            10,
            100,
            1000,
            10000,
        );

        foreach ($numbers as $number)
        {
            $sorter = new Sorter(array(
                'where_to_read_files'         => $this->params['folders']['source'],
                'where_to_create_directories' => $this->params['folders']['destination'],
                'number_of_directories'       => $number,
                'folder_sufix'                => '000',
                'operation'                   => 'c',
                'overwrite'                   => TRUE,
                'types'                       => array('jpg'),
            ));

            $deploy = $sorter->deploy();

            $this->assertIsBool($deploy);
            $this->assertTrue($deploy);

            $report = $sorter->report();

            $this->assertNotEmpty($report);
            $this->assertIsArray($report);
            $this->assertArrayHasKey('bool', $report);
            $this->assertIsArray($report['bool']);
            $this->assertTrue($report['bool']['no_errors']);
            $this->assertTrue($report['bool']['successful_sorting']);
            $this->assertTrue($report['bool']['something_to_sort']);
            $this->assertArrayHasKey('string', $report);
            $this->assertArrayHasKey('array', $report);
            $this->assertIsString($report['string']);
            $this->assertNotEmpty($report['string']);
            $this->assertArrayHasKey('usage', $report['array']);
            $this->assertArrayHasKey('result', $report['array']);

            $errors = $sorter->get_error();

            $this->assertEmpty($errors);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing deploy method - copy opteration - testing is on
    */
    public function test_deploy_method_copy_operation_testing_option()
    {
        $sorter = new Sorter(array(
            'where_to_read_files'         => $this->params['folders']['source'],
            'where_to_create_directories' => $this->params['folders']['destination'],
            'number_of_directories'       => 10,
            'folder_sufix'                => 'xxx',
            'operation'                   => 'c',
            'overwrite'                   => TRUE,
            'types'                       => array('jpg'),
        ));

        $sorter->turn_on();

        $deploy = $sorter->deploy();

        $this->assertIsBool($deploy);
        $this->assertFalse($deploy);

        $report = $sorter->report();

        $this->assertNotEmpty($report);
        $this->assertIsArray($report);
        $this->assertArrayHasKey('bool', $report);
        $this->assertIsArray($report['bool']);
        $this->assertTrue($report['bool']['no_errors']);
        $this->assertFalse($report['bool']['successful_sorting']);
        $this->assertFalse($report['bool']['something_to_sort']);
        $this->assertArrayHasKey('string', $report);
        $this->assertArrayHasKey('array', $report);
        $this->assertIsString($report['string']);
        $this->assertNotEmpty($report['string']);
        $this->assertArrayHasKey('usage', $report['array']);
        $this->assertArrayHasKey('result', $report['array']);

        $errors = $sorter->get_error();

        $this->assertEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing deploy method - move opteration - testing is on
    */
    public function test_deploy_method_move_operation_testing_option()
    {
        $sorter = new Sorter(array(
            'where_to_read_files'         => $this->params['folders']['movable_testing'],
            'where_to_create_directories' => $this->params['folders']['destination'],
            'number_of_directories'       => 10,
            'folder_sufix'                => 'xxx',
            'operation'                   => 'm',
            'overwrite'                   => TRUE,
            'types'                       => array('jpg'),
        ));

        $sorter->turn_on();

        $deploy = $sorter->deploy();

        $this->assertIsBool($deploy);
        $this->assertFalse($deploy);

        $report = $sorter->report();

        $this->assertNotEmpty($report);
        $this->assertIsArray($report);
        $this->assertArrayHasKey('bool', $report);
        $this->assertIsArray($report['bool']);
        $this->assertTrue($report['bool']['no_errors']);
        $this->assertFalse($report['bool']['successful_sorting']);
        $this->assertFalse($report['bool']['something_to_sort']);
        $this->assertArrayHasKey('string', $report);
        $this->assertArrayHasKey('array', $report);
        $this->assertIsString($report['string']);
        $this->assertNotEmpty($report['string']);
        $this->assertArrayHasKey('usage', $report['array']);
        $this->assertArrayHasKey('result', $report['array']);

        $errors = $sorter->get_error();

        $this->assertEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing deploy method for movable option
    */
    public function test_deploy_method_for_movable_option()
    {
        $sorter = new Sorter(array(
            'where_to_read_files'         => $this->params['folders']['movable'],
            'where_to_create_directories' => $this->params['folders']['destination'],
            'number_of_directories'       => 10,
            'folder_sufix'                => '999',
            'operation'                   => 'm',
            'types'                       => array('jpg'),
        ));

        $deploy = $sorter->deploy();

        $this->assertIsBool($deploy);
        $this->assertTrue($deploy);

        $report = $sorter->report();

        $this->assertNotEmpty($report);
        $this->assertIsArray($report);
        $this->assertArrayHasKey('bool', $report);
        $this->assertIsArray($report['bool']);
        $this->assertTrue($report['bool']['no_errors']);
        $this->assertTrue($report['bool']['successful_sorting']);
        $this->assertTrue($report['bool']['something_to_sort']);
        $this->assertArrayHasKey('string', $report);
        $this->assertArrayHasKey('array', $report);
        $this->assertIsString($report['string']);
        $this->assertNotEmpty($report['string']);
        $this->assertArrayHasKey('usage', $report['array']);
        $this->assertArrayHasKey('result', $report['array']);

        $errors = $sorter->get_error();

        $this->assertEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test deploy method for empty parameters
    */
    public function test_deploy_method_for_empty_parameters()
    {
        $sorter = new Sorter(array());

        $deploy = $sorter->deploy();

        $this->assertIsBool($deploy);
        $this->assertFalse($deploy);

        $report = $sorter->report();

        $this->assertNotEmpty($report);
        $this->assertIsArray($report);
        $this->assertArrayHasKey('bool', $report);
        $this->assertIsArray($report['bool']);
        $this->assertFalse($report['bool']['no_errors']);
        $this->assertFalse($report['bool']['successful_sorting']);
        $this->assertFalse($report['bool']['something_to_sort']);
        $this->assertArrayHasKey('string', $report);
        $this->assertArrayHasKey('array', $report);
        $this->assertIsString($report['string']);
        $this->assertNotEmpty($report['string']);
        $this->assertArrayHasKey('usage', $report['array']);
        $this->assertArrayHasKey('result', $report['array']);

        $errors = $sorter->get_error();

        $this->assertNotEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test deploy method only without setting number_of_directories parameter
    */
    public function test_deploy_method_without_number_of_directories()
    {
        $sorter = new Sorter(array(
            'where_to_read_files'         => $this->params['folders']['movable'],
            'where_to_create_directories' => $this->params['folders']['destination'],
            'folder_sufix'                => '000',
            'operation'                   => 'c',
            'types'                       => array('jpg'),
            'settings'                    => array(
                'max_execution_time' => 60,
            ),
        ));

        $deploy = $sorter->deploy();

        $this->assertIsBool($deploy);
        $this->assertFalse($deploy);

        $report = $sorter->report();

        $this->assertNotEmpty($report);
        $this->assertIsArray($report);
        $this->assertArrayHasKey('bool', $report);
        $this->assertIsArray($report['bool']);
        $this->assertFalse($report['bool']['no_errors']);
        $this->assertFalse($report['bool']['successful_sorting']);
        $this->assertFalse($report['bool']['something_to_sort']);
        $this->assertArrayHasKey('string', $report);
        $this->assertArrayHasKey('array', $report);
        $this->assertIsString($report['string']);
        $this->assertNotEmpty($report['string']);
        $this->assertArrayHasKey('usage', $report['array']);
        $this->assertArrayHasKey('result', $report['array']);

        $errors = $sorter->get_error();

        $this->assertNotEmpty($errors);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Sorter test tear down after Sorter
    */
    public static function tearDownAfterClass(): void
    {
        self::delete_destination_folder_and_files();
        self::delete_movable_folder_and_files();

        rmdir(self::$locations['paths']['movable_testing']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Delete destination folder and files
    *
    * @var void
    */
    private static function delete_destination_folder_and_files()
    {
        $listing = Directory_Lister::listing(array(
            'directory' => self::$locations['paths']['destination'],
            'method'    => 'crawl',
        ));

        foreach ($listing['listing'] as $item)
        {
            unlink($item['path']);
        }

        $listing = Directory_Lister::listing(array(
            'directory' => self::$locations['paths']['destination'],
            'method'    => 'folders',
        ));

        foreach ($listing['listing']['path'] as $item)
        {
            rmdir($item);
        }

        rmdir(self::$locations['paths']['destination']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Delete movable folder and files
    *
    * @var void
    */
    private static function delete_movable_folder_and_files()
    {
        $listing = Directory_Lister::listing(array(
            'directory' => self::$locations['paths']['movable'],
            'method'    => 'files',
        ));

        if ( ! is_bool($listing) && $listing['count'] > 0)
        {
            foreach ($listing['listing'] as $item)
            {
                unlink($item['path']);
            }
        }

        rmdir(self::$locations['paths']['movable']);
    }

    /* ---------------------------------------------------------------------- */
}
