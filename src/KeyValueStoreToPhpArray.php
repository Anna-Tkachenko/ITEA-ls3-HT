<?php

/*
 * This file is part of the "Key-Value store" library.
 * (c) Anna Tkachenko <tkachenko.anna835@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App;

class KeyValueStoreToPhpArray implements KeyValueStoreInterface
{
    /**
     * Array of stored elements.
     *
     * @var array
     */
    private $storage = [];

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function get(string $key, $default = null)
    {
        if (isset($this->storage[$key])) {
            return $this->storage[$key];
        }

        return $default;
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->storage);
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function clear(): void
    {
        $this->storage = [];
    }
}
