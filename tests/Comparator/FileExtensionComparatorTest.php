<?php
namespace SGH\Comparable\Filesystem\Test\Comparator;

use SGH\Comparable\Filesystem\Comparator\FileExtensionComparator;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;

/**
 * FileExtensionComparator test case.
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright &copy; 2015 SGH informationstechnologie UG
 * @license MIT
 * @link http://opensource.org/licenses/mit-license.php
 * @package Comparable\Filesystem
 * @since 1.0.0
 */
class FileExtensionComparatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var FileExtensionComparator
     */
    private $fileExtensionComparator;

    private $vfsRoot;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();        
        $this->fileExtensionComparator = new FileExtensionComparator();
        $this->vfsRoot = vfsStream::setup();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->fileExtensionComparator = null;
        $this->vfsRoot = null;
        parent::tearDown();
    }

    /**
     * Tests FileExtensionComparator->compare()
     * 
     * @test
     * @dataProvider dataFileNames
     */
    public function testCompare($fileName1, $fileName2)
    {
        $file1 = new vfsStreamFile($fileName1);
        $this->vfsRoot->addChild($file1);
        $file2 = new vfsStreamFile($fileName2);
        $this->vfsRoot->addChild($file2);
        $actualResult = $this->fileExtensionComparator->compare(
            new \SplFileInfo($file1->url()),
            new \SplFileInfo($file2->url()));
        $this->assertEquals(strcmp(pathinfo($fileName1, PATHINFO_EXTENSION), pathinfo($fileName2, PATHINFO_EXTENSION)), $actualResult);
    }
    /**
     * Tests FileExtensionComparator::calback()
     * 
     * @test
     */
    public function testCallback()
    {
        $callback = FileExtensionComparator::callback();
        $this->assertInstanceOf('\SGH\Comparable\Comparator\InvokableComparator', $callback);
    }
    /**
     * Data provider for testCompare()
     * 
     * @return string[][]
     */
    public static function dataFileNames()
    {
        return array(
            [ 'file.txt', 'file.zip' ],
            [ 'file.zip', 'file.txt' ],
            [ 'file1.txt', 'file2.txt' ],
        );
    }
}

