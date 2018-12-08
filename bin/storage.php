#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 11/30/18
 * Time: 7:03 PM
 */

use App\AbstractKeyValueStoreToFile;
use App\KeyValueStoreToJsonFile;
use App\KeyValueStoreToYamlFile;
use App\KeyValueStoreToPhpArray;

require_once __DIR__ . '/../vendor/autoload.php';


/*$storage1 = new KeyValueStoreToPhpArray();

$storage1->set('name', 'Anna');
$storage1->set('email','mail@example');
var_dump($storage1->get('name'));

var_dump($storage1->has('email'));

$storage1->remove('email');
var_dump($storage1->get('email'));

$storage1->clear();

var_dump($storage1->get('name'));
*/
/*
$storage2 = new KeyValueStoreToYamlFile('data/storage.yaml');

$storage2->set('name', 'Anna');
$storage2->set('mail','email@example');

var_dump($storage2->get('name', ''));

var_dump($storage2->has('mail'));

$storage2->remove('name');
var_dump($storage2->get('name'));


//$storage2->clear();
*/


$storage3 = new KeyValueStoreToJsonFile('data/storage.json');

$storage3->set('name','Anna');
$storage3->set('mail','email@example');
var_dump($storage3->get('name'));


var_dump($storage3->has('mail'));
var_dump($storage3->has('mail'));
var_dump($storage3->has('mail'));

$storage3->remove('name');

//$storage3->clear();
