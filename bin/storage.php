#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: tkachenko
 * Date: 11/30/18
 * Time: 7:03 PM
 */

require_once  __DIR__ . '/../src/console_helper.php';
require_once  __DIR__ . '/../src/KeyValueStore.php';

$storage1 = new KeyValueStore();

$storage1->set('name', 'Anna');
$storage1->set('email','mail@example');
writeln($storage1->get('name'));

writeln($storage1->has('email'));

$storage1->remove('email');
writeln($storage1->get('email'));

$storage1->clear();

writeln($storage1->get('name'));