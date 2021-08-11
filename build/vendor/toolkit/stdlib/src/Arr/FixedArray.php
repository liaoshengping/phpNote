<?php declare(strict_types=1);
/**
 * This file is part of toolkit/stdlib.
 *
 * @author   https://github.com/inhere
 * @link     https://github.com/php-toolkit/stdlib
 * @license  MIT
 */

namespace Toolkit\Stdlib\Arr;

use ArrayAccess;
use IteratorAggregate;
use SplFixedArray;
use function count;

/**
 * Class FixedArray
 *  fixed size array implements, and support string key.
 *  `SplFixedArray` only allow int key.
 *
 * @package Toolkit\Stdlib\Arr
 */
class FixedArray implements ArrayAccess, IteratorAggregate
{
    /**
     * @var array
     * [
     *  'string:key' => 'int:value index'
     * ]
     */
    protected $keys;

    /**
     * @var SplFixedArray
     */
    protected $values;

    /**
     * FixedArray constructor.
     *
     * @param int $size
     */
    public function __construct(int $size = 0)
    {
        $this->keys   = [];
        $this->values = new SplFixedArray($size);
    }

    /**
     * reset
     *
     * @param int $size
     */
    public function reset(int $size = 0): void
    {
        $this->keys   = [];
        $this->values = new SplFixedArray($size);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function __isset(string $key)
    {
        return $this->offsetExists($key);
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function __set(string $key, $value): void
    {
        $this->offsetSet($key, $value);
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function __get(string $key)
    {
        return $this->offsetGet($key);
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->values->getSize();
    }

    /**
     * @param $key
     *
     * @return int
     */
    public function getKeyIndex($key): int
    {
        return $this->keys[$key] ?? -1;
    }

    /**
     * @return array
     */
    public function getKeys(): array
    {
        return $this->keys;
    }

    /**
     * @param array $keys
     */
    public function setKeys(array $keys): void
    {
        $this->keys = $keys;
    }

    /**
     * @return SplFixedArray
     */
    public function getValues(): SplFixedArray
    {
        return $this->values;
    }

    /**
     * @param SplFixedArray $values
     */
    public function setValues(SplFixedArray $values): void
    {
        $this->values = $values;
    }

    /**
     * Defined by IteratorAggregate interface
     * Returns an iterator for this object, for use with foreach
     *
     * @return SplFixedArray
     */
    public function getIterator(): SplFixedArray
    {
        return $this->values;
    }

    /**
     * Checks whether an offset exists in the iterator.
     *
     * @param mixed $offset The array offset.
     *
     * @return  boolean  True if the offset exists, false otherwise.
     */
    public function offsetExists($offset): bool
    {
        return isset($this->keys[$offset]);
    }

    /**
     * Gets an offset in the iterator.
     *
     * @param mixed $offset The array offset.
     *
     * @return  mixed  The array value if it exists, null otherwise.
     */
    public function offsetGet($offset)
    {
        $index = $this->getKeyIndex($offset);

        if ($index >= 0) {
            return $this->values[$index];
        }

        return null;
    }

    /**
     * Sets an offset in the iterator.
     *
     * @param mixed $offset The array offset.
     * @param mixed $value  The array value.
     *
     * @return  void
     */
    public function offsetSet($offset, $value): void
    {
        $index = $this->getSize();

        // change size.
        if ($index <= count($this->keys)) {
            $this->values->setSize($index + 10);
        }

        $this->values[$index] = $value;
        $this->keys[$offset]  = $index;
    }

    /**
     * Unset an offset in the iterator.
     *
     * @param mixed $offset The array offset.
     *
     * @return  void
     */
    public function offsetUnset($offset): void
    {
        $index = $this->getKeyIndex($offset);

        if ($index >= 0) {
            // change size.
            $this->values->setSize($index - 1);

            unset($this->keys[$offset], $this->values[$index]);
        }
    }
}
