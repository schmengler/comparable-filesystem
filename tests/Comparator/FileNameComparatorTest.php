<?php
namespace SGH\Comparable\Filesystem\Test\Comparator;

use SGH\Comparable\Filesystem\Comparator\FileNameComparator;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;

/**
 * FileNameComparator test case.
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright &copy; 2015 SGH informationstechnologie UG
 * @license MIT
 * @link http://opensource.org/licenses/mit-license.php
 * @package Comparable\Filesystem
 * @since 1.0.0
 */
class FileNameComparatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var FileNameComparator
     */
    private $fileNameComparator;

    private $vfsRoot;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();        
        $this->fileNameComparator = new FileNameComparator();
        $this->vfsRoot = vfsStream::setup();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->fileNameComparator = null;
        $this->vfsRoot = null;
        parent::tearDown();
    }

    /**
     * Tests FileNameComparator->compare()
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
        $actualResult = $this->fileNameComparator->compare(
            new \SplFileInfo($file1->url()),
            new \SplFileInfo($file2->url()));
        $this->assertEquals(strcmp($fileName1, $fileName2), $actualResult);
    }
    /**
     * Data provider for testCompare()
     * 
     * @return string[][]
     */
    public static function dataFileNames()
    {
        return array(
            [ 'file_a.txt', 'file_a.txt' ],
            [ 'file_a.txt', 'file_b.txt' ],
            [ 'file_a.txt', 'file_ab.txt' ],
            [ 'file_10.txt', 'file_2.txt' ],
        );
    }
}

