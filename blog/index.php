<?php
error_reporting(-1);
ini_set('display_errors', '1');

$composerInstall = static function() {
    $composerInstall = ['start' => new DateTimeImmutable()];
    exec('composer install 2>&1', $composerOutput, $composerExitCode);
    $composerOutput = array_filter($composerOutput, static function (string $row) {
        return trim($row) !== '';
    });
    $composerOutput = implode("\n", $composerOutput);
    if ($composerExitCode !== 0) {
        $composerInstall['error'] = $composerOutput;
    } else {
        $composerInstall['result'] = $composerOutput;
    }
    $composerInstall['end'] = new DateTimeImmutable();
    $composerInstall['duration'] = $composerInstall['end']->diff($composerInstall['start'])->format('%s.%f s');
    $composerInstall['exit_code'] = $composerExitCode;

    if ($composerExitCode !== 0) {
        echo json_encode($composerInstall, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit($composerExitCode);
    }

    return $composerInstall;
};

$output = [];
if (!file_exists(__DIR__ . '/vendor')) {
    $output['composer_initial_install'] = $composerInstall();
}

require_once __DIR__ . '/vendor/autoload.php';

set_time_limit(60);

header('Content-Type: application/json');
header('Cache-Control: no-cache');

$exitCode = 0;

$codeUpdate = ['start' => new DateTimeImmutable()];
try {
    $codeUpdate['result'] = (new Granam\Git\Git())->update(__DIR__);
} catch (Throwable $throwable) {
    $codeUpdate['error'] = $throwable->getMessage() . '; ' . var_export($throwable->getTrace(), true);
    $exitCode = 1;
}
$codeUpdate['end'] = new DateTimeImmutable();
$codeUpdate['duration'] = $codeUpdate['end']->diff($codeUpdate['start'])->format('%s.%f s');
$codeUpdate['exit_code'] = $exitCode;
$output['code_update'] = $codeUpdate;

if ($exitCode !== 0) {
    echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit($exitCode);
}

$output['composer_install'] = $composerInstall();

$outputGeneration = ['start' => new DateTimeImmutable()];
exec('vendor/bin/statie generate source 2>&1', $generationOutput, $generationCode);
$generationOutput = array_filter($generationOutput, static function (string $row) {
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
$outputGeneration['duration'] = $outputGeneration['end']->diff($outputGeneration['start'])->format('%s.%f s');
$outputGeneration['exit_code'] = $exitCode;
$output['output_generation'] = $outputGeneration;

echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
exit($exitCode);
