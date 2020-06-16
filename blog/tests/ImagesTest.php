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
        foreach (self::getAllPostsImages() as $image) {
            self::assertNotEmpty($image);
        }
    }
}
