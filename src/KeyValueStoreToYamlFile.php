<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 12/1/18
 * Time: 3:34 PM
 */

require_once __DIR__ . '/KeyValueStoreToFile.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

final class KeyValueStoreToYamlFile extends KeyValueStoreToFile
{

    public function setToYaml($key, $value)
    {
        if($this->set($key, $value)) {
            $yaml = Yaml::dump($this->__get('storage'));
            file_put_contents('data/' . $this->__get('file_path'), $yaml);
        }
    }

    public function getFromYaml($key, $default = null)
    {
        $temp_array = Yaml::parseFile('data/' . $this->__get('file_path'));

        return $this->get($key, $default, $temp_array);
    }

    public function has($key)
    {
        $temp_array = Yaml::parseFile('data/' . $this->__get('file_path'));
        return array_key_exists($key, $temp_array);
    }

    public function removeFromYaml($key)
    {
        if($this->remove($key)){
            $yaml = Yaml::dump($this->__get('storage'));
            file_put_contents('data/' . $this->__get('file_path'), $yaml);
        }
    }

    public function clearYaml()
    {
        if($this->clear()){
            $yaml = Yaml::dump($this->__get('storage'));
            file_put_contents('data/' . $this->__get('file_path'), $yaml);
        }

    }
}