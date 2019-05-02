<?php
error_reporting(-1);
ini_set('display_errors', '1');
require_once __DIR__ . '/vendor/autoload.php';

echo implode(
    "\n",
    (new Granam\Git\Git())->update(__DIR__)
);