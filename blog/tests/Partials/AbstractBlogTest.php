<?php declare(strict_types=1);

namespace DrdPlus\Blog\Tests\Partials;

use Gt\Dom\HTMLDocument;
use PHPUnit\Framework\TestCase;

abstract class AbstractBlogTest extends TestCase
{
    protected function getPost(string $postFileName): string
    {
        $post = self::getGeneratedPosts()[$postFileName] ?? null;
        if ($post === null) {
            throw new \LogicException("No post found under name '$postFileName'");
        }
        return $post;
    }

    /**
     * @return array|string[]
     */
    protected static function getGeneratedPosts(): array
    {
        static $postsByFullPath = [];
        if (!$postsByFullPath) {
            $postNames = [];
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
                            if (in_array($blogPostName, $postNames, true)) {
                                throw new \LogicException(
                                    "Post file name '$blogPostName' is already used, check it by\nfind -type d -name '$blogPostName'"
                                );
                            }
                            $postNames[] = $blogPostName;
                            $postsByFullPath[$blockPostFile] = file_get_contents($blockPostFile);
                        }
                    }
                }
            }
        }
        return $postsByFullPath;
    }

    /**
     * @return array|string[][]
     */
    protected static function getAllPostsImages(): array
    {
        $imageLinks = [];
        foreach (static::getGeneratedPosts() as $generatedPost) {
            $dom = new HTMLDocument($generatedPost);
            foreach ($dom->body->getElementsByTagName('img') as $image) {
                $src = $image->getAttribute('src');
                if ($src && strpos($src, 'images/') !== false && strpos($src, 'http') !== 0) {
                    $imageLinks[] = $src;
                }
            }
            foreach ($dom->body->getElementsByTagName('a') as $anchor) {
                $href = $anchor->getAttribute('href');
                if ($href && strpos($href, 'images/') !== false && strpos($href, 'http') !== 0) {
                    $imageLinks[] = $href;
                }
            }
        }
        $uniqueImageLinks = array_unique($imageLinks);
        $images = [];
        $imagesDir = __DIR__ . '/../../source/assets/images';
        foreach ($uniqueImageLinks as $imageLink) {
            $questionMarkPosition = strpos($imageLink, '?');
            $version = '';
            $imageLinkWithoutVersion = $imageLink;
            if ($questionMarkPosition !== false) {
                $version = substr($imageLink, $questionMarkPosition + strlen('?version='));
                $imageLinkWithoutVersion = substr($imageLink, 0, $questionMarkPosition);
            }
            $relativeImageFile = preg_replace('~^/?(assets)?(/images)?/?~', '', $imageLinkWithoutVersion);
            $imageFullPath = $imagesDir . '/' . $relativeImageFile;
            self::assertFileExists($imageFullPath);
            $images[] = ['link' => $imageLink, 'fullPath' => $imageFullPath, 'version' => $version];
        }
        return $images;
    }
}
