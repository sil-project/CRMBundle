<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use AppBundle\Admin\OrganismAdmin;

class OrganismAdminConcrete extends OrganismAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        parent::configureDatagridFilters($datagridMapper);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        AddressableAdmin::configureFormFields($formMapper);
        $formMapper
            ->remove('category_id')
            ->tab('General')
                ->with('')
                    ->add('category')
                ->end()
            ->end()
        ;
        AddressableAdmin::configureFormFields($formMapper);
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        parent::configureShowFields($showMapper);
    }
}
