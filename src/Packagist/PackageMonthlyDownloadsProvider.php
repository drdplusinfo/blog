<?php declare(strict_types=1);

namespace DrdPlus\Blog\Packagist;

use DrdPlus\Blog\Packagist\Purifier\InterveningPackagesPurifier;

final class PackageMonthlyDownloadsProvider
{
    /**
     * @var PackageRawMonthlyDownloadsProvider
     */
    private $packageRawMonthlyDownloadsProvider;

    /**
     * @var InterveningPackagesPurifier
     */
    private $interveningPackagesPurifier;

    public function __construct(
        PackageRawMonthlyDownloadsProvider $packageRawMonthlyDownloadsProvider,
        InterveningPackagesPurifier $interveningPackagesPurifier
    ) {
        $this->packageRawMonthlyDownloadsProvider = $packageRawMonthlyDownloadsProvider;
        $this->interveningPackagesPurifier = $interveningPackagesPurifier;
    }

    /**
     * @return int[]
     */
    public function provideForPackage(string $packageName): array
    {
        $values = $this->packageRawMonthlyDownloadsProvider->provideForPackage($packageName);

        return $this->interveningPackagesPurifier->correctInterveningPackages($values, $packageName);
    }
}
