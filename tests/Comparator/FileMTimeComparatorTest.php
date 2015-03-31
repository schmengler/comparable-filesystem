<?php
namespace SGH\Comparable\Filesystem\Test\Comparator;

use SGH\Comparable\Filesystem\Comparator\FileMTimeComparator;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;

/**
 * FileMTimeComparator test case.
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright &copy; 2015 SGH informationstechnologie UG
 * @license MIT
 * @link http://opensource.org/licenses/mit-license.php
 * @package Comparable\Filesystem
 * @since 1.0.0
 */
class FileMTimeComparatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var FileMTimeComparator
     */
    private $fileMTimeComparator;

    private $vfsRoot;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();        
        $this->fileMTimeComparator = new FileMTimeComparator();
        $this->vfsRoot = vfsStream::setup();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->fileMTimeComparator = null;
        $this->vfsRoot = null;
        parent::tearDown();
    }

    /**
     * Tests FileMTimeComparator->compare()
     * 
     * @test
     * @dataProvider dataFileTimes
     */
    public function testCompare($fileMTime1, $fileMTime2)
    {
        $file1 = new vfsStreamFile('file1');
        $this->vfsRoot->addChild($file1->lastModified($fileMTime1));
        $file2 = new vfsStreamFile('file2');
        $this->vfsRoot->addChild($file2->lastModified($fileMTime2));
        $actualResult = $this->fileMTimeComparator->compare(
            new \SplFileInfo($file1->url()),
            new \SplFileInfo($file2->url()));
        $this->assertEquals($fileMTime1 - $fileMTime2, $actualResult);
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

