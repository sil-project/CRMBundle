<?php

/*
 * Copyright (C) 2015-2016 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Librinfo\CRMBundle\Admin;

use Librinfo\CRMBundle\Admin\OrganismAdmin as BaseOrganismAdmin;

class CustomerAdmin extends BaseOrganismAdmin
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