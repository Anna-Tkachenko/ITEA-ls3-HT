<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 12/1/18
 * Time: 3:34 PM
 */

namespace App;

final class KeyValueStoreToJsonFile extends AbstractKeyValueStoreToFile
{

    protected function load(): array
    {
        $storage = file_get_contents($this->file_path);
        $data = json_decode($storage, true);
        return is_array($data) ? $data : [];
    }

    protected function update(array $data): void
    {
        $json = json_encode($data);
        file_put_contents($this->file_path, $json);
    }

}