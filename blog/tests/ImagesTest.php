<?php declare(strict_types=1);

namespace DrdPlus\Blog\Tests;

use DrdPlus\Blog\Tests\Partials\AbstractBlogTest;

class ImagesTest extends AbstractBlogTest
{
    /**
     * @test
     */
    public function Every_post_image_is_used()
    {
        $allPostImages = self::getAllPostsImages();
        self::assertNotEmpty($allPostImages);
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

    private function getExpectedVersionHint(string $path): string
    {
        return sprintf('?version=%s', md5_file($path));
    }
}
