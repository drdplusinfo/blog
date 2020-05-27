<?php declare(strict_types=1);

namespace DrdPlus\Blog\Tests\Partials;

use PHPUnit\Framework\TestCase;

abstract class AbstractBlogTest extends TestCase
{
    protected function getPost(string $postFileName): string
    {
        $post = self::getPosts()[$postFileName] ?? null;
        if ($post === null) {
            throw new \LogicException("No post found under name '$postFileName'");
        }
        return $post;
    }

    /**
     * @return array|string[]
     */
    protected static function getPosts(): array
    {
        static $posts = [];
        if (!$posts) {
            exec(__DIR__ . '/../../vendor/bin/statie generate source');
            $blogDir = __DIR__ . '/../../output/blog';
            foreach (scandir($blogDir, SCANDIR_SORT_ASCENDING) as $folder) {
                if ($folder === '.' || $folder === '..' || !is_dir($blogDir . '/' . $folder)) {
                    continue;
                }
                $blogYearDir = $blogDir . '/' . $folder;
                foreach (scandir($blogYearDir, SCANDIR_SORT_ASCENDING) as $blogYearFolder) {
                    if ($blogYearFolder === '.' || $blogYearFolder === '..' || !is_dir($blogYearDir . '/' . $blogYearFolder)) {
                        continue;
                    }
                    $blogMonthDir = $blogYearDir . '/' . $blogYearFolder;
                    foreach (scandir($blogMonthDir, SCANDIR_SORT_ASCENDING) as $blogMonthFolder) {
                        if ($blogMonthFolder === '.' || $blogMonthFolder === '..' || !is_dir($blogMonthDir . '/' . $blogMonthFolder)) {
                            continue;
                        }
                        $blogDayDir = $blogMonthDir . '/' . $blogMonthFolder;
                        foreach (scandir($blogDayDir, SCANDIR_SORT_ASCENDING) as $blogDayFolder) {
                            if ($blogDayFolder === '.' || $blogDayFolder === '..' || !is_dir($blogDayDir . '/' . $blogDayFolder)) {
                                continue;
                            }
                            $blogPostName = $blogDayFolder;
                            $blockPostFile = $blogDayDir . '/' . $blogPostName . '/index.html';
                            if (!is_file($blockPostFile)) {
                                continue;
                            }
                            if (!empty($posts[$blogPostName])) {
                                throw new \LogicException(
                                    "Post file name '$blogPostName' is already used, check it by\nfind -type d -name '$blogPostName'"
                                );
                            }
                            $posts[$blogPostName] = file_get_contents($blockPostFile);
                        }
                    }
                }
            }
        }
        return $posts;
    }
}
