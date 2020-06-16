<?php declare(strict_types=1);

namespace DrdPlus\Blog\Tests;

use DrdPlus\Blog\Tests\Partials\AbstractBlogTest;

class ImagesTest extends AbstractBlogTest
{
    /**
     * @test
     */
    public function Images_are_linked_with_their_md5_versions()
    {
        foreach (self::getAllPostsImages() as $image) {
            ['version' => $version, 'fullPath' => $imageFullPath, 'link' => $imageLink] = $image;
            self::assertNotEmpty(
                $version,
                sprintf("Missing version for image %s, expected\n%s", $imageLink, $version ? '' : $this->getExpectedVersionHint($imageFullPath))
            );
            self::assertSame(
                md5_file($imageFullPath),
                $version,
                sprintf("Invalid version for image %s, expected\n%s", $imageLink, $version ? '' : $this->getExpectedVersionHint($imageFullPath))
            );
        }
    }

    /**
     * @test
     */
    public function Every_post_image_is_used()
    {
        $possiblePostImagePaths = $this->getPossiblePostImagePaths();
        $existingPostImagePaths = [];
        foreach (self::getAllPostsImages() as $image) {
            ['fullPath' => $imageFullPath] = $image;
            $existingPostImagePaths[] = realpath($imageFullPath);
        }
        $unusedPostImagePaths = array_diff($possiblePostImagePaths, $existingPostImagePaths);
        self::assertSame([], $unusedPostImagePaths, 'There are some unused post image files');
    }

    /**
     * @return array|string[]
     */
    private function getPossiblePostImagePaths(): array
    {
        $postImagesRealPaths = [];
        $postImagesIterator = new \RecursiveDirectoryIterator(self::getPostImagesBaseDir());
        foreach (new \RecursiveIteratorIterator($postImagesIterator) as $file) {
            /** @var \SplFileInfo $file */
            if ($file->isDir()) {
                continue;
            }
            $postImagesRealPaths[] = $file->getRealPath();
        }
        return $postImagesRealPaths;
    }

    private function getExpectedVersionHint(string $path): string
    {
        return sprintf('?version=%s', md5_file($path));
    }
}
