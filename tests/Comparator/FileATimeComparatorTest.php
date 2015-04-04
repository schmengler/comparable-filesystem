<?php
namespace SGH\Comparable\Filesystem\Test\Comparator;

use SGH\Comparable\Filesystem\Comparator\FileATimeComparator;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;

/**
 * FileATimeComparator test case.
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright &copy; 2015 SGH informationstechnologie UG
 * @license MIT
 * @link http://opensource.org/licenses/mit-license.php
 * @package Comparable\Filesystem
 * @since 1.0.0
 */
class FileATimeComparatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var FileATimeComparator
     */
    private $fileATimeComparator;

    private $vfsRoot;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();        
        $this->fileATimeComparator = new FileATimeComparator();
        $this->vfsRoot = vfsStream::setup();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->fileATimeComparator = null;
        $this->vfsRoot = null;
        parent::tearDown();
    }

    /**
     * Tests FileATimeComparator->compare()
     * 
     * @test
     * @dataProvider dataFileTimes
     */
    public function testCompare($fileATime1, $fileATime2)
    {
        $file1 = new vfsStreamFile('file1');
        $this->vfsRoot->addChild($file1->lastAccessed($fileATime1));
        $file2 = new vfsStreamFile('file2');
        $this->vfsRoot->addChild($file2->lastAccessed($fileATime2));
        $actualResult = $this->fileATimeComparator->compare(
            new \SplFileInfo($file1->url()),
            new \SplFileInfo($file2->url()));
        $this->assertEquals($fileATime1 - $fileATime2, $actualResult);
    }
    /**
     * Tests FileATimeComparator::calback()
     * 
     * @test
     */
    public function testCallback()
    {
        $callback = FileATimeComparator::callback();
        $this->assertInstanceOf('\SGH\Comparable\Comparator\InvokableComparator', $callback);
    }
    /**
     * Data provider for testCompare()
     * 
     * @return int[][]
     */
    public static function dataFileTimes()
    {
        return array(
            [ strtotime('01-01-2000 00:00:00'), strtotime('01-01-2000 00:00:01') ],
            [ strtotime('01-01-1969 00:00:00'), strtotime('01-01-1971 00:00:00') ],
        );
    }
}

