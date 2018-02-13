<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

if (file_exists($file = __DIR__ . '/autoload.php')) {
    require_once $file;
} elseif (file_exists($file = __DIR__ . '/autoload.php.dist')) {
    require_once $file;
}

// try to get Symfony's PHPunit Bridge
$files = array_filter(array(
    __DIR__ . '/../../vendor/symfony/symfony/src/Symfony/Bridge/PhpUnit/bootstrap.php',
    __DIR__ . '/../../vendor/symfony/phpunit-bridge/bootstrap.php',
), 'file_exists');

if ($files) {
    require_once current($files);
}
