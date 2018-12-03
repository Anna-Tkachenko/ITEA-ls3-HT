<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 12/1/18
 * Time: 3:34 PM
 */

require_once __DIR__ . '/KeyValueStoreToFile.php';
require_once __DIR__ . '/KeyValueStoreInterface.php';

final class KeyValueStoreToJsonFile extends KeyValueStoreToFile implements KeyValueStoreInterface
{

    public function set($key, $value)
    {
       if($this->setToStorageArray($key, $value)) {
           file_put_contents('data/' . $this->file_path, json_encode($this->storage));
       }
    }

     public function get($key, $default = null)
    {
        $json_content = file_get_contents('data/' . $this->file_path);
        $temp_array = json_decode($json_content, true);

        return $this->getFromStorageArray($key, $default, $temp_array);
    }

    public function has($key)
    {
        $json_content = file_get_contents('data/' . $this->file_path);
        $temp_array = json_decode($json_content);
        return array_key_exists($key, $temp_array);
    }

    public function remove($key)
    {
        if($this->removeFromStorageArray($key)){
            file_put_contents('data/' . $this->file_path, json_encode($this->storage));
        }
    }

    public function clear()
    {
        if($this->clearStorageArray()){
            file_put_contents('data/' . $this->file_path, json_encode($this->storage));
        }

    }
}