<?php
namespace SGH\Comparable\Filesystem\Comparator;

use SGH\Comparable\Comparator;
use SGH\Comparable\ComparatorException;
use SGH\Comparable\Comparator\InvokableComparator;

/**
 * Base class for SplFileInfo comparators
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright &copy; 2015 SGH informationstechnologie UG
 * @license MIT
 * @link http://opensource.org/licenses/mit-license.php
 * @package Comparable\Filesystem
 * @since 1.0.0
 */
abstract class AbstractFileComparator implements Comparator
{
    /**
     * Verifies that both operands are SplFileInfo instances
     * 
     * @param unknown $object1
     * @param unknown $object2
     * @throws ComparatorException
     */
    protected function checkTypes($object1, $object2)
    {
        if (! $object1 instanceof \SplFileInfo) {
            throw new ComparatorException('$object1 (type: ' . gettype($object1) . ') is no instance of SplFileInfo.');
        }
        if (! $object2 instanceof \SplFileInfo) {
            throw new ComparatorException('$object2 (type: ' . gettype($object2) . ') is no instance of SplFileInfo.');
        }
    }
    /**
     * Returns a callback object that can be used for core functions that take a callback parameter
     *
     * @return \SGH\Comparable\Comparator\InvokableComparator
     */
    public static function callback()
    {
        return new InvokableComparator(new static);
    }
}