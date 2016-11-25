<?php

namespace Librinfo\CRMBundle\Admin;

use Blast\CoreBundle\Admin\Traits\Base as BaseAdmin;

class PhoneTypeAdminConcrete extends PhoneTypeAdmin
{
    use BaseAdmin;

    /**
     * @todo : find a way to do this automatically for entities that have the Sortable trait
     */
    protected $datagridValues = array(
        '_sort_by' => 'sortRank',
    );
}
