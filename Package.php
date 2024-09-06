<?php

namespace CMW\Package\Newsletter;

use CMW\Manager\Package\IPackageConfig;
use CMW\Manager\Package\PackageMenuType;
use CMW\Manager\Package\PackageSubMenuType;

class Package implements IPackageConfig
{
    public function name(): string
    {
        return 'Newsletter';
    }

    public function version(): string
    {
        return '0.0.1';
    }

    public function authors(): array
    {
        return ['Zomb'];
    }

    public function isGame(): bool
    {
        return false;
    }

    public function isCore(): bool
    {
        return false;
    }

    public function menus(): ?array
    {
        return [
            new PackageMenuType(
                lang: 'fr',
                icon: 'fas fa-bullhorn',
                title: 'Newsletter',
                url: 'newsletter/manage',
                permission: 'newsletter.show',
                subMenus: []
            ),
            new PackageMenuType(
                lang: 'en',
                icon: 'fas fa-bullhorn',
                title: 'Newsletter',
                url: 'newsletter/manage',
                permission: 'newsletter.show',
                subMenus: []
            )
        ];
    }

    public function requiredPackages(): array
    {
        return ['Core'];
    }

    public function uninstall(): bool
    {
        // Return true, we don't need other operations for uninstall.
        return true;
    }
}
