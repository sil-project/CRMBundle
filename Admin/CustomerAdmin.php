<?php

/*
 * This file is part of the Sil Project.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Admin;

use Sil\Bundle\CRMBundle\CodeGenerator\CustomerCodeGenerator;
use Sil\Bundle\CRMBundle\Admin\OrganismAdmin as BaseOrganismAdmin;
use Sil\Bundle\CRMBundle\Form\DataTransformer\CustomerCodeTransformer;
use Sonata\AdminBundle\Form\FormMapper;

class CustomerAdmin extends BaseOrganismAdmin
{
    /**
     * @var CustomerCodeGenerator
     */
    private $codeGenerator;

    protected $baseRouteName = 'admin_sil_crm_customer';
    protected $baseRoutePattern = 'sil/crm/customer';
    protected $classnameLabel = 'Customer';

    public function configureFormFields(FormMapper $mapper)
    {
        parent::configureFormFields($mapper);
        $this->renameFormGroup('form_group_organism', 'form_tab_general', 'form_group_customer');
    }

    /**
     * {@inheritdoc}
     */
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $query->andWhere('o.isCustomer = true');

        return $query;
    }

    /**
     * @param FormMapper $mapper
     */
    protected function postConfigureFormFields(FormMapper $mapper)
    {
        parent::postConfigureFormFields($mapper);
        $mapper->get('customerCode')->addViewTransformer(new CustomerCodeTransformer());
    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $object = parent::getNewInstance();

        $object->setisCustomer(true);
        $object->setCustomerCode($this->codeGenerator->generate($object));

        return $object;
    }

    /**
     * @param SeedProducerCodeGenerator $codeGenerator
     */
    public function setCodeGenerator(CustomerCodeGenerator $codeGenerator)
    {
        $this->codeGenerator = $codeGenerator;
    }
}
