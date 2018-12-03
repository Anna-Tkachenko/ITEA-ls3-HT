<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 12/1/18
 * Time: 3:34 PM
 */

require_once __DIR__ . '/KeyValueStoreToFile.php';

final class KeyValueStoreToJsonFile extends KeyValueStoreToFile
{

    public function setToJson($key, $value)
    {
       if($this->set($key, $value)) {
           file_put_contents('data/' . $this->__get('file_path'), json_encode($this->__get('storage')));
       }
    }

     public function getFromJson($key, $default = null)
    {
        $json_content = file_get_contents('data/' . $this->__get('file_path'));
        $temp_array = json_decode($json_content, true);

        return $this->get($key, $default, $temp_array);
    }

    public function has($key)
    {
        $json_content = file_get_contents('data/' . $this->__get('file_path'));
        $temp_array = json_decode($json_content);
        return array_key_exists($key, $temp_array);
    }

    public function removeFromJson($key)
    {
        if($this->remove($key)){
            file_put_contents('data/' . $this->__get('file_path'), json_encode($this->__get('storage')));
        }
    }

    public function clearJson()
    {
        if($this->clear()){
            file_put_contents('data/' . $this->__get('file_path'), json_encode($this->__get('storage')));
        }

    }
}