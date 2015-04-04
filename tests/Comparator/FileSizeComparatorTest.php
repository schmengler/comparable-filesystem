<?php
namespace SGH\Comparable\Filesystem\Test\Comparator;

use SGH\Comparable\Filesystem\Comparator\FileSizeComparator;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;

/**
 * FileSizeComparator test case.
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright &copy; 2015 SGH informationstechnologie UG
 * @license MIT
 * @link http://opensource.org/licenses/mit-license.php
 * @package Comparable\Filesystem
 * @since 1.0.0
 */
class FileSizeComparatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var FileSizeComparator
     */
    private $fileSizeComparator;

    private $vfsRoot;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();        
        $this->fileSizeComparator = new FileSizeComparator();
        $this->vfsRoot = vfsStream::setup();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->fileSizeComparator = null;
        $this->vfsRoot = null;
        parent::tearDown();
    }

    /**
     * Tests FileSizeComparator->compare()
     * 
     * @test
     * @dataProvider dataFileSizes
     */
    public function testCompare($fileSize1, $fileSize2)
    {
        $file1 = new vfsStreamFile('file1');
        $this->vfsRoot->addChild($file1->withContent(str_repeat('X', $fileSize1)));
        $file2 = new vfsStreamFile('file2');
        $this->vfsRoot->addChild($file2->withContent(str_repeat('X', $fileSize2)));
        $actualResult = $this->fileSizeComparator->compare(
            new \SplFileInfo($file1->url()),
            new \SplFileInfo($file2->url()));
        $this->assertEquals($fileSize1 - $fileSize2, $actualResult);
    }
    /**
     * Tests FileSizeComparator::calback()
     * 
     * @test
     */
    public function testCallback()
    {
        $callback = FileSizeComparator::callback();
        $this->assertInstanceOf('\SGH\Comparable\Comparator\InvokableComparator', $callback);
    }
    /**
     * Data provider for testCompare()
     * 
     * @return int[][]
     */
    public static function dataFileSizes()
    {
        return array(
            [ 0, 1 ],
            [ 1, 0 ],
            [ 1, 2 ],
            [ 1024, 1025 ]
        );
    }
}

