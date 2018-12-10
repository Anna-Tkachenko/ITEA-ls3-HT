<?php

/*
 * This file is part of the "Key-Value store" library.
 * (c) Anna Tkachenko <tkachenko.anna835@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App;

use Symfony\Component\Yaml\Yaml;

final class KeyValueStoreToYamlFile extends AbstractKeyValueStoreToFile
{
    /**
     * {@inheritdoc}
     */
    protected function load(): array
    {
        $data = Yaml::parseFile($this->file_path);
        return is_array($data) ? $data : [];
    }

    /**
     * {@inheritdoc}
     */
    protected function update(array $data): void
    {
        $yaml = Yaml::dump($data);
        file_put_contents($this->file_path, $yaml);
    }
}
