<?php declare(strict_types=1);

namespace DrdPlus\Blog\Tests;

use DrdPlus\Blog\Tests\Partials\AbstractBlogTest;

class JustSomeTest extends AbstractBlogTest
{
    /**
     * @test
     */
    public function I_can_use_all_posts()
    {
        self::assertNotEmpty(self::getPosts());
    }
}
