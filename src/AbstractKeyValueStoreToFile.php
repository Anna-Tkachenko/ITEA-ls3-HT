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
    /**
     * Full path to the file.
     *
     * @var string
     */
    protected $file_path;

    /**
     * Loads file content and converts it to array.
     *
     * @return array Converted file content.
     */
    abstract protected function load(): array;

    /**
     * Converts data in file content and loads it to file.
     *
     * @param array $data
     */
    abstract protected function update(array $data): void;

    public function __construct(string $file_path)
    {
        $this->file_path = $file_path;
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $key, $value): void
    {
        if (is_string($key)) {
            $data = $this->load();
            $data[$key] = is_object($value) ? serialize($value) : $value;
            $this->update($data);
        } else {
            throw new \LogicException(
                \sprintf("Invalid format of argument. Key '%s' is not string", $key)
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key, $default = null)
    {
        $data = $this->load();
        if (isset($data[$key])) {
            return $data[$key];
        }

        return $default;
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $key): bool
    {
        $data = $this->load();
        return isset($data[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(string $key): void
    {
        $data = $this->load();
        if (isset($data[$key])) {
            unset($data[$key]);
            $this->update($data);
        } else {
            throw new \LogicException(
                \sprintf("Key '%s' does not exists in this storage", $key)
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clear(): void
    {
        file_put_contents($this->file_path, '', \LOCK_EX);
    }
}
