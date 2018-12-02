<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 11/30/18
 * Time: 6:41 PM
 */

interface KeyValueStoreInterface
{
    /**
     * Stores value by key.
     *
     * @param string  $key   Name of the key.
     * @param mixed   $value Value to store.
     */
    public function set($key, $value);

    /**
     * Gets value by key.
     *
     * @param string     $key     Name of the key.
     * @param null|mixed $default Default value.
     *
     * @return mixed Can be of any type: int, string, null, array, e.g.
     * If value does not exist for provided key, $default will be returned.
     */
    public function get($key, $default = null, $temp_array = null);

    /**
     * Checks whether value is exist by key.
     *
     * @param string $key Name of key.
     *
     * @return bool Returns true if key exists, false otherwise.
     */
    public function has($key);

    /**
     * Removes value by key.
     *
     * @param string $key Name of key.
     */
    public function remove($key);

    /**
     * Removes all keys and their values from the storage.
     */
    public function clear();
}