<?php

namespace Librinfo\CRMBundle\Admin;

use Doctrine\ORM\EntityManager;
use Librinfo\CRMBundle\CodeGenerator\CustomerCodeGenerator;
use Librinfo\CRMBundle\Admin\OrganismAdminConcrete as BaseOrganismAdminConcrete;

class CustomerAdmin extends BaseOrganismAdminConcrete
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

        $query->andWhere('o.customer = true');
        
        return $query;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $object = parent::getNewInstance();
       
        $object->setCustomer(true);
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