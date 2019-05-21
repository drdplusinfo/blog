<?php
error_reporting(-1);
ini_set('display_errors', '1');
require_once __DIR__ . '/vendor/autoload.php';

header('Content-Type: application/json');
header('Cache-Control: no-cache');

$output = [];
$exitCode = 0;

/*$codeUpdate = ['start' => new DateTimeImmutable()];
try {
    $codeUpdate['result'] = (new Granam\Git\Git())->update(__DIR__);
} catch (Throwable $throwable) {
    $codeUpdate['error'] = $throwable->getMessage() . '; ' . var_export($throwable->getTrace(), true);
    $exitCode = 1;
}
$codeUpdate['end'] = new DateTimeImmutable();
$codeUpdate['duration'] = $codeUpdate['end']->diff($codeUpdate['start']);
$codeUpdate['exit_code'] = $exitCode;
$output['code_update'] = $codeUpdate;

if ($exitCode !== 0) {
    echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit($exitCode);
}*/

$composerInstall = ['start' => new DateTimeImmutable()];
exec('composer install', $composerOutput, $composerCode);
$composerOutput = array_filter($composerOutput, function (string $row) {
    return trim($row) !== '';
});
$composerOutput = implode("\n", $composerOutput);
if ($composerCode !== 0) {
    $composerInstall['error'] = $composerOutput;
    $exitCode = $composerCode;
} else {
    $composerInstall['result'] = $composerOutput;
}
$composerInstall['end'] = new DateTimeImmutable();
$composerInstall['duration'] = $composerInstall['end']->diff($composerInstall['start']);
$composerInstall['exit_code'] = $exitCode;
$output['composer_install'] = $composerInstall;

if ($exitCode !== 0) {
    echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit($exitCode);
}

$outputGeneration = ['start' => new DateTimeImmutable()];
exec('vendor/bin/statie generate source 2>&1', $generationOutput, $generationCode);
$generationOutput = array_filter($generationOutput, function (string $row) {
    return trim($row) !== '';
});
$generationOutput = implode("\n", $generationOutput);
if ($generationCode !== 0) {
    $outputGeneration['error'] = $generationOutput;
    $exitCode = $generationCode;
} else {
    $outputGeneration['result'] = $generationOutput;
}
$outputGeneration['end'] = new DateTimeImmutable();
$outputGeneration['duration'] = $outputGeneration['end']->diff($outputGeneration['start']);
$outputGeneration['exit_code'] = $exitCode;
$output['output_generation'] = $outputGeneration;

echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
exit($exitCode);
