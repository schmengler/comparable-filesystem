<?php
namespace SGH\Comparable\Filesystem\Comparator;

/**
 * Compares file extensions
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright &copy; 2015 SGH informationstechnologie UG
 * @license MIT
 * @link http://opensource.org/licenses/mit-license.php
 * @package Comparable\Filesystem
 * @since 1.1.0
 */
class FileExtensionComparator extends AbstractFileComparator
{
	/* (non-PHPdoc)
     * @see \SGH\Comparable\Comparator::compare()
     */
    public function compare($object1, $object2)
    {
		$this->checkTypes($object1, $object2);
		return strcmp($object1->getExtension(), $object2->getExtension());
    }
}