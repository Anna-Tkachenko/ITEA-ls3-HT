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

    abstract protected function load(): array;

    abstract protected function update(array $data): void;

    public function __construct(string $file_path)
    {
        $this->file_path = $file_path;
    }

    public function set(string $key, $value): void
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

    public function get(string $key, $default = null)
    {
        $data = $this->load();
        if (isset($data[$key])) {
            return $data[$key];
        }

        return $default;
    }

    public function has(string $key): bool
    {
        $data = $this->load();
        return isset($data[$key]);
    }

    public function remove(string $key): void
    {
        $data = $this->load();
        if (isset($data[$key])) {
            unset($data[$key]);
            $this->update($data);
        }

        throw new \LogicException(
            \sprintf("Key '%s' does not exists in this storage", $key)
        );
    }

    public function clear(): void
    {
        file_put_contents($this->file_path, '', \LOCK_EX);
    }
}
