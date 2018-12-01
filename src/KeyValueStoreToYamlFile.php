<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 11/30/18
 * Time: 9:18 PM
 */

require_once __DIR__ . '/KeyValueStoreInterface.php';

class KeyValueStoreToYamlFile implements KeyValueStoreInterface
{
    private $storage = [];

    public function set($key, $value)
    {
        if (is_string($key)) {
            $this->storage[$key] = $value;
            yaml_emit_file('./storage.yaml', $this->storage);
        } else {
            throw new \LogicException(
                \sprintf("Invalid format of argument. Key '%s' is not string", $key)
            );
        }
    }

    public function get($key, $default = null)
    {
        $temp_array = yaml_parse_file('./storage.yaml');
        if(isset($temp_array[$key])){
            return $temp_array[$key];
        }

        return $default;
    }

    public function has($key)
    {
        $temp_array = yaml_parse_file('./storage.yaml');
        if(array_key_exists($key, $temp_array)){
            return true;
        }

        return false;
    }

    public function remove($key)
    {
        if (isset($this->storage[$key])) {
            unset($this->storage[$key]);
            yaml_emit_file('./storage.yaml', $this->storage);
        } else {
            throw new \LogicException(
                \sprintf("Key '%s' does not exists in YAML file", $key)
            );
        }
    }

    public function clear()
    {
        $this->storage = [];
        yaml_emit_file('./storage.yaml', $this->storage);
    }
}