<?php

namespace CMW\Permissions\Newsletter;

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Permission\IPermissionInit;
use CMW\Manager\Permission\PermissionInitType;

class Permissions implements IPermissionInit
{
    public function permissions(): array
    {
        return [
            new PermissionInitType(
                code: 'newsletter.show',
                description: LangManager::translate('newsletter.permissions.newsletter.show'),
            ),
            new PermissionInitType(
                code: 'newsletter.show.settings',
                description: LangManager::translate('newsletter.permissions.newsletter.settings'),
            ),
            new PermissionInitType(
                code: 'newsletter.show.send',
                description: LangManager::translate('newsletter.permissions.newsletter.send'),
            ),
            new PermissionInitType(
                code: 'newsletter.users.add',
                description: LangManager::translate('newsletter.permissions.newsletter.external.users.add'),
            ),
            new PermissionInitType(
                code: 'newsletter.users.delete',
                description: LangManager::translate('newsletter.permissions.newsletter.external.users.delete'),
            ),
        ];
    }
}
