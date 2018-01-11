<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Admin;

use Blast\Bundle\CoreBundle\Admin\CoreAdmin;
use Sil\Bundle\CRMBundle\Admin\Traits\ZipCityFormEventsHandler;
use Sonata\AdminBundle\Form\FormMapper;

class AddressAdmin extends CoreAdmin
{
    use ZipCityFormEventsHandler;
    /**
     * @var string
     */
    protected $translationLabelPrefix = 'sil.crm.address';

    protected $baseRouteName = 'admin_crm_address';
    protected $baseRoutePattern = 'crm/address';

    /**
     * @param FormMapper $mapper
     */
    protected function configureFormFields(FormMapper $mapper)
    {
        parent::configureFormFields($mapper);

        $this->handleZipCityFormType($mapper, [
            'city'     => 'city',
            'postCode' => 'zip',
        ]);
    }
}
