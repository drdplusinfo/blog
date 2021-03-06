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
            $command = __DIR__ . '/../../vendor/bin/statie generate source';
            if (extension_loaded('xdebug')) {
                $command = 'php -dzend_extension=xdebug.so ' . $command;
            }
            exec($command);
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
        static $images = [];
        if (count($images) > 0) {
            return $images;
        }
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
        $imageLinks = array_map('urldecode', $imageLinks);
        $uniqueImageLinks = array_unique($imageLinks);
        $imagesDir = self::getImagesBaseDir();
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
        self::assertNotEmpty($images);
        return $images;
    }

    protected static function getImagesBaseDir(): string
    {
        return __DIR__ . '/../../source/assets/images';
    }

    protected static function getPostImagesBaseDir(): string
    {
        return __DIR__ . '/../../source/assets/images/posts';
    }

    protected function getExpectedVersionHint(string $path): string
    {
        return sprintf('?version=%s', md5_file($path));
    }

    protected static function getFavicon(): array
    {
        static $favicon;
        if ($favicon) {
            return $favicon;
        }
        $faviconLink = null;
        foreach (static::getGeneratedPosts() as $generatedPost) {
            $dom = new HTMLDocument($generatedPost);
            foreach ($dom->head->getElementsByTagName('link') as $link) {
                $type = $link->getAttribute('type');
                if ($type && $type === 'image/x-icon') {
                    $faviconLink = $link->getAttribute('href');
                    break;
                }
            }
        }
        if (!$faviconLink) {
            throw new \RuntimeException('Favicon has not been found');
        }
        $faviconLink = urldecode($faviconLink);
        $projectRootDir = self::projectRootDir();
        $questionMarkPosition = strpos($faviconLink, '?');
        $version = '';
        $faviconLinkWithoutVersion = $faviconLink;
        if ($questionMarkPosition !== false) {
            $version = substr($faviconLink, $questionMarkPosition + strlen('?version='));
            $faviconLinkWithoutVersion = substr($faviconLink, 0, $questionMarkPosition);
        }
        $relativeFaviconPath = $faviconLinkWithoutVersion;
        $imageFullPath = $projectRootDir . '/output/' . $relativeFaviconPath;
        self::assertFileExists($imageFullPath);
        $favicon = ['link' => $faviconLink, 'fullPath' => $imageFullPath, 'version' => $version];
        self::assertNotEmpty($favicon);
        return $favicon;
    }

    protected static function projectRootDir(): string
    {
        return __DIR__ . '/../..';
    }

    /**
     * @return array|string[][]
     */
    protected static function getAllCssFiles(): array
    {
        static $cssFiles = [];
        if (count($cssFiles) > 0) {
            return $cssFiles;
        }
        $links = [];
        $generatedPosts = static::getGeneratedPosts();
        $generatedPost = reset($generatedPosts);
        $dom = new HTMLDocument($generatedPost);
        foreach ($dom->head->getElementsByTagName('link') as $link) {
            $href = $link->getAttribute('href');
            if ($href && strpos($href, 'assets/css/') !== false && strpos($href, 'http') !== 0) {
                $links[] = $href;
            }
        }
        self::assertNotEmpty($links, sprintf('No CSS files found in a post %s', key($generatedPosts)));

        $cssBaseDir = self::getCssBaseDir();
        foreach ($links as $link) {
            $questionMarkPosition = strpos($link, '?');
            $version = '';
            $linkWithoutVersion = $link;
            if ($questionMarkPosition !== false) {
                $version = substr($link, $questionMarkPosition + strlen('?version='));
                $linkWithoutVersion = substr($link, 0, $questionMarkPosition);
            }
            $relativeFilePath = preg_replace('~^/?(assets)?(/css)?/?~', '', $linkWithoutVersion);
            $fullPath = $cssBaseDir . '/' . $relativeFilePath;
            self::assertFileExists($fullPath);
            $cssFiles[] = ['link' => $link, 'fullPath' => $fullPath, 'version' => $version];
        }
        return $cssFiles;
    }

    protected static function getCssBaseDir(): string
    {
        return __DIR__ . '/../../source/assets/css';
    }
}
