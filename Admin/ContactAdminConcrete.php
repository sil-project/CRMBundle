<?php

namespace Librinfo\CRMBundle\Admin;

use Librinfo\CoreBundle\Admin\Traits\HandlesRelationsAdmin;
use Librinfo\CoreBundle\Admin\Traits\Normalize;

class ContactAdminConcrete extends ContactAdmin
{
    use HandlesRelationsAdmin, Normalize;

    private $configParameter = 'librinfo_crm';
}

