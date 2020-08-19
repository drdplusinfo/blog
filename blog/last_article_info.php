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
$lastArticleImage = null;
if ($lastArticlePath) {
    preg_match('~<meta property="og:image" content="(?<image>[^"]+)"/>~', file_get_contents($lastArticlePath), $matches);
    $lastArticleImage = $matches['image'];
}

function assembleUrl(string $filePath): string {
    $urlPath = preg_replace('~^.*/(blog/\d+/.+)/index[.]html$~', '$1', $filePath);
    $host = preg_replace('~^update[.]~', '', $_SERVER['HTTP_HOST']);
    return $_SERVER['REQUEST_SCHEME'] . '://' . $host . '/' . $urlPath;
}

header('Content-Type: application/json');
header('Cache-Control: no-cache');
header('Access-Control-Allow-Origin: *');

echo json_encode([
    'data' => [
        'last_article_date' => max($dates)->format(DATE_ATOM),
        'last_article_title' => $lastArticleTitle ? trim($lastArticleTitle) : '',
        'last_article_url' => $lastArticlePath ? assembleUrl($lastArticlePath) : '',
        'last_article_image' => $lastArticlePath ? $lastArticleImage : '',
    ],
    'generated' => (new DateTime())->format(DATE_ATOM),
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
