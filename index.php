<?php
error_reporting(-1);
ini_set('display_errors', '0');
require_once __DIR__ . '/vendor/autoload.php';

header('Content-Type: application/json');
header('Cache-Control: no-cache');

$output = [];
$exitCode = 0;

$start = new DateTimeImmutable();
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
if ($exitCode > 0) {
    echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit($exitCode);
}

$composerInstall = ['start' => new DateTimeImmutable()];
exec('composer install --optimize-autoloader --no-interaction 2>&1', $composerInstallOutput, $exitCode);
if ($exitCode === 0) {
    $composerInstall['result'] = $composerInstallOutput;
} else {
    $composerInstall['error'] = $composerInstallOutput;
}
$composerInstall['end'] = new DateTimeImmutable();
$composerInstall['duration'] = $composerInstall['end']->diff($composerInstall['start']);
$composerInstall['exit_code'] = $exitCode;
$output['composer_install'] = $composerInstall;
if ($exitCode > 0) {
    echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit($exitCode);
}

$outputGenerating = ['start' => new DateTimeImmutable()];
exec(__DIR__ . '/vendor/bin/statie generate source 2>&1', $outputGeneratingOutput, $exitCode);
$outputGeneratingOutput = array_filter($outputGeneratingOutput, function (string $line) {
    return trim($line) !== '';
});
if ($exitCode === 0) {
    $outputGenerating['result'] = $outputGeneratingOutput;
} else {
    $outputGenerating['error'] = $outputGeneratingOutput;
}
$outputGenerating['end'] = new DateTimeImmutable();
$outputGenerating['duration'] = $outputGenerating['end']->diff($outputGenerating['start']);
$outputGenerating['exit_code'] = $exitCode;
$output['output_generating'] = $outputGenerating;

$outputGenerating['total_duration'] = (new DateTimeImmutable())->diff($start);
$error = error_get_last();
if ($error) {
    $outputGenerating['error'] = $error;
}

echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
exit($exitCode);