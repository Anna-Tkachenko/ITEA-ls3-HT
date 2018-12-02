<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 12/1/18
 * Time: 3:34 PM
 */

require_once __DIR__ . '/KeyValueStoreToFile.php';

class KeyValueStoreToYamlFile extends KeyValueStoreToFile
{

    public function setToYaml($key, $value)
    {
        if($this->set($key, $value)) {
            yaml_emit_file('data/' . $this->__get('file_path'), $this->__get('storage'));
        }
    }

    public function getFromYaml($key, $default = null)
    {
        $temp_array = yaml_parse_file('data/' . $this->__get('file_path'));

        return $this->get($key, $default, $temp_array);
    }

    public function has($key)
    {
        $temp_array = yaml_parse_file('data/' . $this->__get('file_path'));
        return array_key_exists($key, $temp_array);
    }

    public function removeFromYaml($key)
    {
        if($this->remove($key)){
            yaml_emit_file('data/' . $this->__get('file_path'), $this->__get('storage'));
        }
    }

    public function clearYaml()
    {
        if($this->clear()){
            yaml_emit_file('data/' . $this->__get('file_path'), $this->__get('storage'));
        }

    }
}