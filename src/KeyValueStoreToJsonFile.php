<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 12/1/18
 * Time: 3:34 PM
 */

require_once __DIR__ . '/KeyValueStoreInterface.php';

class KeyValueStoreToJsonFile implements KeyValueStoreInterface
{
    private $storage = [];

    public function set($key, $value)
    {
        if (is_string($key)) {
            $this->storage[$key] = $value;
            file_put_contents('./storage.json', json_encode($this->storage));
        } else {
            throw new \LogicException(
                \sprintf("Invalid format of argument. Key '%s' is not string", $key)
            );
        }
    }

    public function get($key, $default = null)
    {
        $json_content = file_get_contents('./storage.json');
        $temp_array = json_decode($json_content);

        foreach ($temp_array as $temp_key => $value) {
            if ($temp_key == $key){
                return $value;
            }
        }

        return $default;
    }

    public function has($key)
    {
        $json_content = file_get_contents('./storage.json');
        $temp_array = json_decode($json_content);

        foreach ($temp_array as $temp_key => $value) {
            if ($temp_key == $key){
                return true;
            }
        }

        return false;
    }

    public function remove($key)
    {
        if (isset($this->storage[$key])) {
            unset($this->storage[$key]);
            file_put_contents('./storage.json', json_encode($this->storage));
        } else {
            throw new \LogicException(
                \sprintf("Key '%s' does not exists in JSON file", $key)
            );
        }
    }

    public function clear()
    {
        $this->storage = [];
        file_put_contents('./storage.json', json_encode($this->storage));
    }
}