<?php

namespace Librinfo\CRMBundle\Admin;

use Blast\CoreBundle\Admin\CoreAdmin;
use Blast\CoreBundle\Admin\Traits\Base as BaseAdmin;
use Blast\BaseEntitiesBundle\Admin\Traits\NestedTreeableAdmin;

class CategoryAdmin extends CoreAdmin
{
   use BaseAdmin,
       NestedTreeableAdmin
    ;
}
