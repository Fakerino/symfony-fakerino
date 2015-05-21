<?php
/**
 * This file is part of the Symfony Fakerino Bundle.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

call_user_func(function() {
        if (!is_file($autoloadFile = __DIR__.'/../vendor/autoload.php')) {
            throw new \RuntimeException('Did not find vendor/autoload.php. Did you run "composer install --dev"?');
        }
        require_once $autoloadFile;
    });