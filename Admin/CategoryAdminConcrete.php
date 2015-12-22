<?php

namespace Librinfo\CRMBundle\Admin;

use Librinfo\CoreBundle\Admin\Traits\Base as BaseAdmin;

class CategoryAdminConcrete extends CategoryAdmin
{
    use BaseAdmin;
    
    protected $datagridValues = array(
        '_page'       => 1,
        '_sort_order' => 'ASC',
        '_sort_by'    => 'sortMaterializedPath',
    );
}
