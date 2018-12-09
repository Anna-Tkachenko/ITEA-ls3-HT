<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 11/30/18
 * Time: 7:03 PM
 */

namespace App;

class KeyValueStoreToPhpArray implements KeyValueStoreInterface
{

    private $storage = [];

    public function set(string $key, $value): void
    {
        if (is_string($key)) {
            $this->storage[$key] = $value;
        } else {
            throw new \LogicException(
                \sprintf("Invalid format of argument. Key '%s' is not string", $key)
            );
        }
    }

    public function get(string $key, $default = null)
    {
        if(isset($this->storage[$key])){
            return $this->storage[$key];
        }

        return $default;

    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->storage);
    }

    public function remove(string $key): void
    {
        if (isset($this->storage[$key])) {
            unset($this->storage[$key]);
        } else {
            throw new \LogicException(
                \sprintf("Key '%s' does not exists in storage %s", $key, self::class)
            );
        }
    }

    public function clear(): void
    {
        $this->storage = [];
    }
}