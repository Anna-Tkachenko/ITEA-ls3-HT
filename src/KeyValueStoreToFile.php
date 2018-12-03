<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 12/2/18
 * Time: 9:18 PM
 */



abstract class KeyValueStoreToFile
{
    protected $storage = [];
    protected $file_path;

    public function __construct($file_path)
    {
        $this->file_path = $file_path;
    }

    protected function setToStorageArray($key, $value)
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

    protected function getFromStorageArray($key, $default = null, $temp_array = null)
    {
        if(isset($temp_array[$key])){
            return $temp_array[$key];
        }

        return $default;
    }

    protected function removeFromStorageArray($key)
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

    protected function clearStorageArray()
    {
        $this->storage = [];
        return true;
    }
}