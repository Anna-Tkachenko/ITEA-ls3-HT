<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 12/2/18
 * Time: 9:18 PM
 */

require_once __DIR__ . '/KeyValueStoreInterface.php';

abstract class KeyValueStoreToFile implements KeyValueStoreInterface
{
    private $storage = [];
    private $file_path;

    public function __construct($file_path)
    {
        $this->file_path = $file_path;
    }

    public function __get($value)
    {
        return $this->$value;
    }

    public function set($key, $value)
    {
        if (is_string($key)) {
            $this->storage[$key] = $value;
            return true;
        } else {
            throw new \LogicException(
                \sprintf("Invalid format of argument. Key '%s' is not string", $key)
            );
        }
    }

    public function get($key, $default = null, $temp_array = null)
    {
        if(isset($temp_array[$key])){
            return $temp_array[$key];
        }

        return $default;
    }

    public function has($key)
    {

    }

    public function remove($key)
    {
        if (isset($this->storage[$key])) {
            unset($this->storage[$key]);
            return true;
        } else {
            throw new \LogicException(
                \sprintf("Key '%s' does not exists in this storage", $key)
            );
        }
    }

    public function clear()
    {
        $this->storage = [];
        return true;
    }
}