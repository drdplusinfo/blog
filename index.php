<?php
error_reporting(-1);
ini_set('display_errors', '1');
require_once __DIR__ . '/vendor/autoload.php';

header('Content-Type: application/json');
header('Cache-Control: no-cache');

$output = [];
$exitCode = 0;

$codeUpdate = ['start' => new DateTimeImmutable()];
try {
    $codeUpdate['result'] = (new Granam\Git\Git())->update(__DIR__);
} catch (Throwable $throwable) {
    $codeUpdate['error'] = $throwable->getTraceAsString();
    $exitCode = 1;
}
$codeUpdate['end'] = new DateTimeImmutable();
$codeUpdate['duration'] = $codeUpdate['end']->diff($codeUpdate['start']);
$codeUpdate['exit_code'] = $exitCode;
$output['code_update'] = $codeUpdate;

echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
exit($exitCode);
