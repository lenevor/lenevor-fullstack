<?php 

namespace Syscode\Debug\Engine;

use Countable;
use Exception;
use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;

/**
 * Lenevor PHP Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file license.md.
 * It is also available through the world-wide-web at this URL:
 * https://lenevor.com/license
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@Lenevor.com so we can send you a copy immediately.
 *
 * @package     Lenevor
 * @subpackage  Base
 * @author      Javier Alexander Campo M. <jalexcam@gmail.com>
 * @link        https://lenevor.com 
 * @copyright   Copyright (c) 2018-2019 Lenevor Framework 
 * @license     https://lenevor.com/license or see /license.md or see https://opensource.org/licenses/BSD-3-Clause New BSD license
 * @since       0.8.0
 */
class Collection implements ArrayAccess, IteratorAggregate, Countable
{
    /**
     * @var array $frames
     */
    protected $frames;

    /**
     * Constructor. Initialize Collection class.
     * 
     * @param  array  $frames
     * 
     * @return array
     */
    public function __construct(array $frames)
    {
        $this->frames = array_map(function ($frame) {
            return new Frame($frame);
        }, $frames);
    }

    /**
     * Count all elements of an object Frame.
     * 
     * @see    Countable::count
     * 
     * @return int
     */
    public function count()
    {
        return count($this->frames);
    }

    /**
     * Returns an array with all frames.
     * 
     * @see    Collection::getIterator
     * 
     * @return array
     */
    public function getArray()
    {
        return $this->frames;
    }

    /**
     * Retrieve an external iterator.
     * 
     * @see    IteratorAggregate::getIterator
     * 
     * @return new \ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->frames);
    }

    /**
     * Whether or not an offset exists.
     * 
     * @see    \ArrayAccess::offsetExists
     * 
     * @return int
     */
    public function offsetExists($offset)
    {
        return isset($this->frames[$offset]);
    }

    /**
     * Retrieve a value offset.
     * 
     * @see    \ArrayAccess::offsetGet
     * @param  int  $offset
     * 
     * @return int
     */
    public function offsetGet($offset)
    {
        return $this->frames[$offset];
    }

    /**
     * Assigns a value to the specified offset.
     * 
     * @see    \ArrayAccess::offsetSet
     * @param  int  $offset
     * 
     * @throws \Exception
     */
    public function offsetSet($offset, $value)
    {
        throw new Exception(__CLASS__.' is read only');
    }

    /**
     * Unset an offset.
     * 
     * @see    \ArrayAccess::offsetUnset
     * @param  int  $offset
     * 
     * @throws \Exception
     */
    public function offsetUnset($offset)
    {
        throw new Exception(__CLASS__.' is read only');
    }

    /**
     * Array of Frame instances.
     * 
     * @param  array  $frames
     * 
     * @return array
     */
    public function prependFrames(array $frames)
    {
        $this->frames = array_merge($frames, $this->frames);
    }
}