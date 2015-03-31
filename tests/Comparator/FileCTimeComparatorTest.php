<?php
namespace SGH\Comparable\Filesystem\Test\Comparator;

use SGH\Comparable\Filesystem\Comparator\FileCTimeComparator;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;

/**
 * FileCTimeComparator test case.
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright &copy; 2015 SGH informationstechnologie UG
 * @license MIT
 * @link http://opensource.org/licenses/mit-license.php
 * @package Comparable\Filesystem
 * @since 1.0.0
 */
class FileCTimeComparatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var FileCTimeComparator
     */
    private $fileCTimeComparator;

    private $vfsRoot;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();        
        $this->fileCTimeComparator = new FileCTimeComparator();
        $this->vfsRoot = vfsStream::setup();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->fileCTimeComparator = null;
        $this->vfsRoot = null;
        parent::tearDown();
    }

    /**
     * Tests FileCTimeComparator->compare()
     * 
     * @test
     * @dataProvider dataFileTimes
     */
    public function testCompare($fileCTime1, $fileCTime2)
    {
        $file1 = new vfsStreamFile('file1');
        $this->vfsRoot->addChild($file1->lastAttributeModified($fileCTime1));
        $file2 = new vfsStreamFile('file2');
        $this->vfsRoot->addChild($file2->lastAttributeModified($fileCTime2));
        $actualResult = $this->fileCTimeComparator->compare(
            new \SplFileInfo($file1->url()),
            new \SplFileInfo($file2->url()));
        $this->assertEquals($fileCTime1 - $fileCTime2, $actualResult);
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

