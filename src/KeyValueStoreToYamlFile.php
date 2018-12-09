<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 12/1/18
 * Time: 3:34 PM
 */

namespace App;

use Symfony\Component\Yaml\Yaml;

final class KeyValueStoreToYamlFile extends AbstractKeyValueStoreToFile
{
    protected function load(): array
    {
        $data = Yaml::parseFile($this->file_path);
        return is_array($data) ? $data : [];
    }
    protected function update(array $data): void
    {
        $yaml = Yaml::dump($data);
        file_put_contents($this->file_path, $yaml);
    }
}
