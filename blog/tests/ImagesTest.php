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
            $questionMarkPosition = strpos($image, '?');
            $version = '';
            $imageWithoutVersion = $image;
            if ($questionMarkPosition !== false) {
                $version = substr($image, $questionMarkPosition + strlen('?version='));
                $imageWithoutVersion = substr($image, 0, $questionMarkPosition);
            }
            self::assertNotEmpty(
                $version,
                sprintf("Missing version for image %s, expected\n%s", $image, $version ? '' : $this->getExpectedVersionHint($image))
            );
            self::assertSame(
                md5_file($imageWithoutVersion),
                $version,
                sprintf("Invalid version for image %s, expected\n%s", $image, $version ? '' : $this->getExpectedVersionHint($image))
            );
        }
        // TODO detect unused images
    }

    private function getExpectedVersionHint(string $image): string
    {
        return sprintf('?version=%s', $image);
    }
}
