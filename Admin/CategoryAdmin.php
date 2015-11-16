<?php

namespace Librinfo\CRMBundle\Admin;

use Librinfo\CoreBundle\Admin\TreeableAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CategoryAdmin extends TreeableAdmin
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
//        parent::configureListFields($listMapper);
        $listMapper
            ->add('name')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show'   => array(),
                    'edit'   => array(),
                    'delete' => array(),
                )
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
//        parent::configureFormFields($formMapper);
        $formMapper
            ->add('name')
            ->add('parentNode', 'treeable', array(
                    'class'       => 'LibrinfoCRMBundle:Category',
                    'required'    => false,
                    'empty_value' => '- - -'
                )
            );
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
//        parent::configureShowFields($showMapper);
        $showMapper
            ->add('name')
            ->add('parentNode');
    }
}
