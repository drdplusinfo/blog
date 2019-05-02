<?php
error_reporting(-1);
ini_set('display_errors', '1');
require_once __DIR__ . '/vendor/autoload.php';

echo implode(
    "\n",
    (new Granam\Git\Git())->update(__DIR__)
);

exec(__DIR__ . '/vendor/bin/statie generate source', $output);
print_r(array_filter($output));