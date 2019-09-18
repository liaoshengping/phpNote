<?php
class ArrayAndObjectAccess implements ArrayAccess {

    /**
     * register
     *
     * @var array
     * @access private
     */
    private $register = [];

    /**
     * Get a register by key
     *
     * @param string The key register to retrieve
     * @access public
     */
    public function &__get ($key) {
        return $this->register[$key];
    }

    /**
     * Assigns a value to the specified register
     *
     * @param string The register key to assign the value to
     * @param mixed  The value to set
     * @access public
     */
    public function __set($key,$value) {
        $this->register[$key] = $value;
    }

    /**
     * Whether or not an register exists by key
     *
     * @param string An register key to check for
     * @access public
     * @return boolean
     * @abstracting ArrayAccess
     */
    public function __isset ($key) {
        return isset($this->register[$key]);
    }

    /**
     * Unsets an register by key
     *
     * @param string The key to unset
     * @access public
     */
    public function __unset($key) {
        unset($this->register[$key]);
    }

    /**
     * Assigns a value to the specified offset
     *
     * @param string The offset to assign the value to
     * @param mixed  The value to set
     * @access public
     * @abstracting ArrayAccess
     */
    public function offsetSet($offset,$value) {
        if (is_null($offset)) {
            $this->register[] = $value;
        } else {
            $this->register[$offset] = $value;
        }
    }

    /**
     * Whether or not an offset exists
     *
     * @param string An offset to check for
     * @access public
     * @return boolean
     * @abstracting ArrayAccess
     */
    public function offsetExists($offset) {
        return isset($this->register[$offset]);
    }

    /**
     * Unsets an offset
     *
     * @param string The offset to unset
     * @access public
     * @abstracting ArrayAccess
     */
    public function offsetUnset($offset) {
        if ($this->offsetExists($offset)) {
            unset($this->register[$offset]);
        }
    }

    /**
     * Returns the value at specified offset
     *
     * @param string The offset to retrieve
     * @access public
     * @return mixed
     * @abstracting ArrayAccess
     */
    public function offsetGet($offset) {
        return $this->offsetExists($offset) ? $this->register[$offset] : null;
    }

}
class demo extends ArrayAndObjectAccess{

}
//$obj = new demo();
//$foo = new ArrayAndObjectAccess();
//// Set register as array and object
//$foo->fname = 'Yousef';
//$foo->lname = 'Ismaeil';
//// Call as object
//echo 'fname as object ' . $foo->fname . "\n";
//// Call as array
//echo 'lname as array ' . $foo['lname'] . "\n";
//// Reset as array
//$foo['fname'] = 'Cliprz';
//echo $foo['fname'] . "\n";

/** Outputs
 * fname as object Yousef
 * lname as array Ismaeil
 * Cliprz
 */
