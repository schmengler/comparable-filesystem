<?php
namespace SGH\Comparable\Filesystem\Test\Comparator;

use SGH\Comparable\Filesystem\Comparator\FileTypeComparator;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use org\bovigo\vfs\vfsStreamDirectory;

/**
 * FileTypeComparator test case.
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright &copy; 2015 SGH informationstechnologie UG
 * @license MIT
 * @link http://opensource.org/licenses/mit-license.php
 * @package Comparable\Filesystem
 * @since 1.0.0
 */
class FileTypeComparatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var FileTypeComparator
     */
    private $fileTypeComparator;

    private $vfsRoot;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();        
        $this->fileTypeComparator = new FileTypeComparator();
        $this->vfsRoot = vfsStream::setup();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->fileTypeComparator = null;
        $this->vfsRoot = null;
        parent::tearDown();
    }

    /**
     * Tests FileTypeComparator->compare()
     * 
     * @test
     */
    public function testCompare()
    {
        $file1 = new vfsStreamFile('file1.zip');
        $this->vfsRoot->addChild($file1);
        $file2 = new vfsStreamFile('file2.txt');
        $this->vfsRoot->addChild($file2);
        $dir = new vfsStreamDirectory('dir');
        $this->vfsRoot->addChild($dir);
        
        $this->assertEquals(0, $this->fileTypeComparator->compare(
            new \SplFileInfo($file1->url()),
            new \SplFileInfo($file2->url())), 'Both type "file"');
        $this->assertLessThan(0, $this->fileTypeComparator->compare(
            new \SplFileInfo($dir->url()),
            new \SplFileInfo($file2->url())), 'type "dir" < type "file"');
        $this->markTestIncomplete('Cannot test type "link" with vfsStream');
    }
    /**
     * Tests FileTypeComparator::calback()
     * 
     * @test
     */
    public function testCallback()
    {
        $callback = FileTypeComparator::callback();
        $this->assertInstanceOf('\SGH\Comparable\Comparator\InvokableComparator', $callback);
    }
}

