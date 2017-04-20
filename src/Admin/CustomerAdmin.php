<?php

/*
 * Copyright (C) 2015-2016 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Librinfo\CRMBundle\Admin;

use Librinfo\CRMBundle\CodeGenerator\CustomerCodeGenerator;
use Librinfo\CRMBundle\Admin\OrganismAdmin as BaseOrganismAdmin;
use Librinfo\CRMBundle\Form\DataTransformer\CustomerCodeTransformer;
use Sonata\AdminBundle\Form\FormMapper;

class CustomerAdmin extends BaseOrganismAdmin
{
    /**
     * @var CustomerCodeGenerator
     */
    private $codeGenerator;

    protected $baseRouteName = 'admin_librinfo_crm_customer';
    protected $baseRoutePattern = 'librinfo/crm/customer';
    protected $classnameLabel = 'Customer';

    public function configureFormFields(FormMapper $mapper)
    {
        parent::configureFormFields($mapper);
        $this->renameFormGroup('form_group_organism', 'form_group_general', 'form_group_customer');
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
     *
     * @param SeedProducerCodeGenerator $codeGenerator
     */
    public function setCodeGenerator(CustomerCodeGenerator $codeGenerator)
    {
        $this->codeGenerator = $codeGenerator;
    }
}