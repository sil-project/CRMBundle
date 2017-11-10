<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

foreach (glob(__DIR__ . '/AppBundle/Entity/OuterExtension/*/*.php') as $file) {
    require_once $file;
}
