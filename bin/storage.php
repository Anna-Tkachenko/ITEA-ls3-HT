#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 11/30/18
 * Time: 7:03 PM
 */

require_once  __DIR__ . '/../src/console_helper.php';
require_once __DIR__ . '/../src/KeyValueStoreToPhpArray.php';
require_once __DIR__ . '/../src/KeyValueStoreToYamlFile.php';
require_once __DIR__ . '/../src/KeyValueStoreToJsonFile.php';


/*$storage1 = new KeyValueStoreToPhpArray();

$storage1->set('name', 'Anna');
$storage1->set('email','mail@example');
writeln($storage1->get('name'));

writeln($storage1->has('email'));

$storage1->remove('email');
writeln($storage1->get('email'));

$storage1->clear();

writeln($storage1->get('name'));
*/

$storage2 = new KeyValueStoreToYamlFile('storage.yaml');

$storage2->setToYaml('name', 'Anna');
$storage2->setToYaml('mail','email@example');

writeln($storage2->getFromYaml('name', ''));

writeln($storage2->has('mail'));

$storage2->removeFromYaml('name');
writeln($storage2->getFromYaml('name'));

//$storage2->clear();
/*

$storage3 = new KeyValueStoreToJsonFile('storage.json');

$storage3->setToJson('name','Anna');
$storage3->setToJson('mail','email@example');
writeln($storage3->getFromJson('name'));


writeln($storage3->has('mail'));
writeln($storage3->has('mail'));
writeln($storage3->has('mail'));

$storage3->removeFromJson('name'); */

//$storage3->clear();
