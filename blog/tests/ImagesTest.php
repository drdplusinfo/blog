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
        $images = self::getAllPostsImages();
        $images[] = self::getFavicon();
        $imagesWithoutVersion = [];
        $imagesWithInvalidVersion = [];
        foreach ($images as $image) {
            ['version' => $version, 'fullPath' => $imageFullPath] = $image;
            if (empty($version)) {
                $imagesWithoutVersion[] = $image;
                continue;
            }
            if (md5_file($imageFullPath) !== $version) {
                $imagesWithInvalidVersion[] = $image;
            }
        }
        $errorMessages = [];
        foreach ($imagesWithoutVersion as $imageWithoutVersion) {
            ['version' => $version, 'fullPath' => $imageFullPath, 'link' => $imageLink] = $imageWithoutVersion;
            $errorMessages[] = sprintf("Missing version for image %s, expected\n%s", $imageLink, $version ? '' : $this->getExpectedVersionHint($imageFullPath));
        }
        foreach ($imagesWithInvalidVersion as $imageWithInvalidVersion) {
            ['version' => $version, 'fullPath' => $imageFullPath, 'link' => $imageLink] = $imageWithInvalidVersion;
            $errorMessages[] = sprintf("Invalid version for image %s, expected\n%s", $imageLink, $this->getExpectedVersionHint($imageFullPath));
        }
        self::assertCount(
            0,
            $errorMessages,
            implode("\n", $errorMessages)
        );
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
}
