<?php declare(strict_types=1);

namespace DrdPlus\Blog\Tests;

use DrdPlus\Blog\Tests\Partials\AbstractBlogTest;

class CssTest extends AbstractBlogTest
{
    /**
     * @test
     */
    public function Css_files_are_linked_with_their_md5_versions()
    {
        foreach (self::getAllCssFiles() as $cssFile) {
            ['version' => $version, 'fullPath' => $fullPath, 'link' => $link] = $cssFile;
            self::assertNotEmpty(
                $version,
                sprintf("Missing version for CSS file %s, expected\n%s", $link, $this->getExpectedVersionHint($fullPath))
            );
            self::assertSame(
                md5_file($fullPath),
                $version,
                sprintf("Invalid version for CSS file %s, expected\n%s", $link, $this->getExpectedVersionHint($fullPath))
            );
        }
    }

    /**
     * @test
     */
    public function Every_css_file_is_used()
    {
        $possibleCssFilePaths = $this->getPossibleCssFilePaths();
        $existingCssFilePaths = [];
        foreach (self::getAllCssFiles() as $cssFile) {
            ['fullPath' => $fullPath] = $cssFile;
            $existingCssFilePaths[] = realpath($fullPath);
        }
        $unusedCssFilePaths = array_diff($possibleCssFilePaths, $existingCssFilePaths);
        self::assertSame([], $unusedCssFilePaths, 'There are some unused CSS files');
    }

    /**
     * @return array|string[]
     */
    private function getPossibleCssFilePaths(): array
    {
        $CssFilesRealPaths = [];
        $cssFilesDirIterator = new \RecursiveDirectoryIterator(self::getCssBaseDir());
        foreach (new \RecursiveIteratorIterator($cssFilesDirIterator) as $file) {
            /** @var \SplFileInfo $file */
            if ($file->isDir()) {
                continue;
            }
            $CssFilesRealPaths[] = $file->getRealPath();
        }
        return $CssFilesRealPaths;
    }
}
