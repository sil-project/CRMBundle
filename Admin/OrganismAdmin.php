<?php

namespace Librinfo\CRMBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Librinfo\CoreBundle\Admin\Admin;

class OrganismAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('country')
            ->add('npai')
            ->add('email')
            ->add('emailNpai')
            ->add('emailNoNewsletter')
            ->add('description')
            ->add('vcardUid')
            ->add('confirmed')
            ->add('url')
            ->add('administrativeNumber')
//            ->add('categories')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('country')
            ->add('npai')
            ->add('email')
            ->add('emailNpai')
            ->add('emailNoNewsletter')
            ->add('description')
            ->add('vcardUid')
            ->add('confirmed')
            ->add('url')
            ->add('administrativeNumber')
            ->add('categories')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
//            ->add('id')
            ->add('name')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('country')
            ->add('npai')
            ->add('email')
            ->add('emailNpai')
            ->add('emailNoNewsletter')
            ->add('description')
            ->add('vcardUid')
            ->add('confirmed')
            ->add('url')
            ->add('administrativeNumber')
            ->add('categories')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('country')
            ->add('npai')
            ->add('email')
            ->add('emailNpai')
            ->add('emailNoNewsletter')
            ->add('description')
            ->add('vcardUid')
            ->add('confirmed')
            ->add('url')
            ->add('administrativeNumber')
            ->add('categories')
        ;
    }
}
