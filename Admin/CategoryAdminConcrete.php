<?php

namespace Librinfo\CRMBundle\Admin;

use Blast\CoreBundle\Admin\Traits\Base as BaseAdmin;
use Librinfo\BaseEntitiesBundle\Admin\Traits\NestedTreeableAdmin;

class CategoryAdminConcrete extends CategoryAdmin
{
    use BaseAdmin,
        NestedTreeableAdmin
        ;
}
