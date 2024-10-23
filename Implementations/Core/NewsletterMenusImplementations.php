<?php

namespace CMW\Implementation\Newsletter\Core;

use CMW\Interface\Core\IMenus;
use CMW\Model\News\NewsModel;

class NewsletterMenusImplementations implements IMenus
{
    public function getRoutes(): array
    {
        $slug = [];
        $slug['Newsletter'] = 'newsletter';

        return $slug;
    }

    public function getPackageName(): string
    {
        return 'Newsletter';
    }
}
