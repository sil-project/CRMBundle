<?php

namespace Librinfo\CRMBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Librinfo\CRMBundle\Admin\ContactAdmin;
use Librinfo\CoreBundle\Admin\AddressableAdmin;

class ContactAdminConcrete extends ContactAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        parent::configureDatagridFilters($datagridMapper);
        $this->removeInternalFields($datagridMapper);
        $this->orderFields($datagridMapper);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);
        $this->removeInternalFields($listMapper);
        $this->orderFields($listMapper);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        AddressableAdmin::configureFormFields($formMapper);
        $formMapper
            ->remove('name')
            ->remove('email')
            ->tab('General')
                ->with('')
                    ->add('title')
                    ->add('name')
                    ->add('firstname')
                    ->add('email')
                ->end()
            ->end()
            ->tab('Ticketting')
                ->with('History')
                ->end()
                ->with('Control')
                    ->add('flashOnControl')
                ->end()
            ->end()
            ->tab('Specifics')
                ->with('Communication')
                    ->add('culture')
                ->end()
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        parent::configureShowFields($showMapper);
        $this->removeInternalFields($showMapper);
        $this->orderFields($showMapper);
    }
}

