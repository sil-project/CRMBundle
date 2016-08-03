<?php

namespace Librinfo\CRMBundle\Admin;

use Librinfo\CoreBundle\Admin\CoreAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ContactEmbeddedAdmin extends CoreAdmin
{
    protected $baseRouteName = 'admin_vendor_bundlename_adminclassname';
    protected $baseRoutePattern = 'unique-route-pattern';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('firstname')
            ->add('name', 'text', ['required' => false])
            ->add('address')
            ->add('zip')
            ->add('city')
            ->add('country')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
    }
}
