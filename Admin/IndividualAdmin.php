<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Admin;

class IndividualAdmin extends OrganismAdmin
{
    /**
     * @var string
     */
    protected $translationLabelPrefix = 'sil.crm.individual';

    protected $baseRouteName = 'admin_crm_individual';
    protected $baseRoutePattern = 'crm/individual';
}
