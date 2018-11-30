<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 11/30/18
 * Time: 7:03 PM
 */

require_once __DIR__ . '/KeyValueStoreInterface.php';

class KeyValueStore implements KeyValueStoreInterface
{

    private $storage = [];

    public function set($key, $value)
    {
        if (is_string($key)) {
            $this->storage[$key] = $value;
        } else {
            throw new \LogicException(
                \sprintf("Invalid format of argument. Key '%s' is not string", $key)
            );
        }
    }

    public function get($key, $default = null)
    {
        if(isset($this->storage[$key])){
            return $this->storage[$key];
        }

        return $default;

    }

    public function has($key)
    {
        if(array_key_exists($key, $this->storage)){
            return true;
        }

        return false;
    }

    public function remove($key)
    {
        if (isset($this->storage[$key])) {
            unset($this->storage[$key]);
        } else {
            throw new \LogicException(
                \sprintf("Key '%s' does not exists in storage %s", $key, self::class)
            );
        }
    }

    public function clear()
    {
        $this->storage = [];
    }
}