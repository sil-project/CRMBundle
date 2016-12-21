<?php

namespace Librinfo\CRMBundle\Admin;

use Librinfo\CRMBundle\Admin\OrganismAdminConcrete as BaseOrganismAdminConcrete;

class CustomerAdmin extends BaseOrganismAdminConcrete
{
    protected $baseRouteName = 'admin_librinfo_crm_customer';
    protected $baseRoutePattern = 'librinfo/crm/customer';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $query->andWhere('o.customer = true');
        
        return $query;
    }
}