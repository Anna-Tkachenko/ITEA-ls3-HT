<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 12/2/18
 * Time: 9:18 PM
 */

namespace App;

abstract class AbstractKeyValueStoreToFile implements KeyValueStoreInterface
{
    protected $file_path;

    abstract protected function load();

    abstract protected function update(array $data);

    public function __construct($file_path)
    {
        $this->file_path = $file_path;
    }

    public function set($key, $value)
    {
        if (is_string($key)) {
            $data = $this->load();
            $data[$key] = $value;
            $this->update($data);
        } else {
            throw new \LogicException(
                \sprintf("Invalid format of argument. Key '%s' is not string", $key)
            );
        }
    }

    public function get($key, $default = null)
    {
        $data = $this->load();
        if (isset($data[$key])) {
            return $data[$key];
        }

        return $default;
    }

    public function has($key){
        $data = $this->load();
        return isset($data[$key]);
    }

    public function remove($key)
    {
        $data = $this->load();
        if (isset($data[$key])) {
            unset($data[$key]);
            $this->update($data);
            return true;
        }

        throw new \LogicException(
            \sprintf("Key '%s' does not exists in this storage", $key)
        );
    }

    public function clear()
    {
        file_put_contents($this->file_path, '', \LOCK_EX);
    }
}