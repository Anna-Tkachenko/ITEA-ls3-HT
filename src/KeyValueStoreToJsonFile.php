<?php

/*
 * This file is part of the "Key-Value store" library.
 * (c) Anna Tkachenko <tkachenko.anna835@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App;

final class KeyValueStoreToJsonFile extends AbstractKeyValueStoreToFile
{
    /**
     * {@inheritdoc}
     */
    protected function load(): array
    {
        $storage = file_get_contents($this->file_path);
        $data = json_decode($storage, true);
        return is_array($data) ? $data : [];
    }

    /**
     * {@inheritdoc}
     */
    protected function update(array $data): void
    {
        $json = json_encode($data);
        file_put_contents($this->file_path, $json);
    }
}
