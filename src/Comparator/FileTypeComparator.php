<?php
namespace SGH\Comparable\Filesystem\Comparator;

/**
 * Compares file types (types are "dir", "file" and "link")
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright &copy; 2015 SGH informationstechnologie UG
 * @license MIT
 * @link http://opensource.org/licenses/mit-license.php
 * @package Comparable\Filesystem
 * @since 1.0.0
 */
class FileTypeComparator extends AbstractFileComparator
{
	/* (non-PHPdoc)
     * @see \SGH\Comparable\Comparator::compare()
     */
    public function compare($object1, $object2)
    {
		$this->checkTypes($object1, $object2);
		return strcmp($object1->getType(), $object2->getType());
    }
}