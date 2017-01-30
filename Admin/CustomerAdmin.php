<?php

/*
 * Copyright (C) 2015-2016 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Librinfo\CRMBundle\Admin;

use Doctrine\ORM\EntityManager;
use Librinfo\CRMBundle\CodeGenerator\CustomerCodeGenerator;
use Librinfo\CRMBundle\Admin\OrganismAdmin as BaseOrganismAdmin;

class CustomerAdmin extends BaseOrganismAdmin
{
    /**
     *
     * @var EntityManager
     */
    private $manager;
    
    /**
     *
     * @var SeedProducerCodeGenerator
     */
    private $codeGenerator;
    
    protected $baseRouteName = 'admin_librinfo_crm_customer';
    protected $baseRoutePattern = 'librinfo/crm/customer';

    /**
     * {@inheritdoc}
     */
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $query->andWhere('o.is_customer = true');

        return $query;
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
     * @param EntityManager $manager
     */
    public function setManager(EntityManager $manager)
    {
        $this->manager = $manager;
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