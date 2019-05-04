<?php
error_reporting(-1);
ini_set('display_errors', '1');
require_once __DIR__ . '/vendor/autoload.php';

echo implode(
    "\n",
    (new Granam\Git\Git())->update(__DIR__)
);

passthru('composer install --optimize-autoloader --no-interaction 2>&1', $return);
if ($return !== 0) {
    throw new RuntimeException('Can not install libraries via Composer');
}

passthru(__DIR__ . '/vendor/bin/statie generate source 2>&1', $return);
if ($return !== 0) {
    throw new RuntimeException('Can not generate output by Statie');
}