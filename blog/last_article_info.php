<?php
$dates = [];
foreach (glob(__DIR__ . '/source/_posts/*/*.md') ?: [] as $articlePath) {
    $article = basename($articlePath);
    preg_match('~^(?<date>\d+-\d+-\d+)~', $article, $matches);
    $dates[] = DateTime::createFromFormat('Y-m-d', $matches['date']);
}
/** @var DateTime $lastDate */
$lastDate = max($dates);
$lastDate->setTime(0, 0, 0);

$lastArticlePath = null;
foreach (glob(__DIR__ . "/output/blog/{$lastDate->format('Y')}/{$lastDate->format('m')}/{$lastDate->format('d')}/*/index.html") ?: [] as $articlePath) {
    $lastArticlePath = $articlePath;
}
$lastArticleTitle = null;
if ($lastArticlePath) {
    preg_match('~<meta property="og:title" content="(?<title>[^"]+)"/>~', file_get_contents($lastArticlePath), $matches);
    $lastArticleTitle = $matches['title'];
}

header('Content-Type: application/json');
header('Cache-Control: no-cache');
header('Access-Control-Allow-Origin: *');

echo json_encode([
    'data' => [
        'last_article_date' => max($dates)->format(DATE_ATOM),
        'last_article_title' => $lastArticleTitle ? trim($lastArticleTitle) : '',
    ],
    'generated' => (new DateTime())->format(DATE_ATOM),
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
