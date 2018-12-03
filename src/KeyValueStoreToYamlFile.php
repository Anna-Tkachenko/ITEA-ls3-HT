<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 12/1/18
 * Time: 3:34 PM
 */

require_once __DIR__ . '/KeyValueStoreToFile.php';
require_once __DIR__ . '/KeyValueStoreInterface.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

final class KeyValueStoreToYamlFile extends KeyValueStoreToFile implements KeyValueStoreInterface
{

    public function set($key, $value)
    {
        if($this->setToStorageArray($key, $value)) {
            $yaml = Yaml::dump($this->storage);
            file_put_contents('data/' . $this->file_path, $yaml);
        }
    }

    public function get($key, $default = null)
    {
        $temp_array = Yaml::parseFile('data/' . $this->file_path);

        return $this->getFromStorageArray($key, $default, $temp_array);
    }

    public function has($key)
    {
        $temp_array = Yaml::parseFile('data/' . $this->file_path);
        return array_key_exists($key, $temp_array);
    }

    public function remove($key)
    {
        if($this->removeFromStorageArray($key)){
            $yaml = Yaml::dump($this->storage);
            file_put_contents('data/' . $this->file_path, $yaml);
        }
    }

    public function clear()
    {
        if($this->clearStorageArray()){
            $yaml = Yaml::dump($this->storage);
            file_put_contents('data/' . $this->file_path, $yaml);
        }

    }
}