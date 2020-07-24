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
        $stylesWithoutVersion = [];
        $stylesWithInvalidVersion = [];
        foreach (self::getAllCssFiles() as $cssFile) {
            ['version' => $version, 'fullPath' => $fullPath, 'link' => $link] = $cssFile;
            if (empty($version)) {
                $stylesWithoutVersion[] = $cssFile;
                continue;
            }
            if (md5_file($fullPath) !== $version) {
                $stylesWithInvalidVersion[] = $cssFile;
            }
        }
        $errorMessages = [];
        foreach ($stylesWithoutVersion as $styleWithoutVersion) {
            ['version' => $version, 'fullPath' => $fullPath, 'link' => $link] = $styleWithoutVersion;
            $errorMessages[] = sprintf("Missing version for CSS file %s, expected\n%s", $link, $version ? '' : $this->getExpectedVersionHint($fullPath));
        }
        foreach ($stylesWithInvalidVersion as $styleWithInvalidVersion) {
            ['version' => $version, 'fullPath' => $fullPath, 'link' => $link] = $styleWithInvalidVersion;
            $errorMessages[] = sprintf("Invalid version for CSS file %s, expected\n%s", $link, $this->getExpectedVersionHint($fullPath));
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
