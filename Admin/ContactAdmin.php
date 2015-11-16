<?php

namespace Librinfo\CRMBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Librinfo\CoreBundle\Admin\CoreAdmin;

class ContactAdmin extends CoreAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('firstname')
            ->add('shortname')
            ->add('title')
            ->add('flashOnControl')
            ->add('password')
            ->add('familyContact')
            ->add('culture')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('zip')
            ->add('city')
            ->add('country')
            ->add('npai')
            ->add('email')
            ->add('emailNpai')
            ->add('emailNoNewsletter')
            ->add('vcardUid')
            ->add('confirmed')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('firstname')
            ->add('shortname')
            ->add('title')
            ->add('flashOnControl')
            ->add('password')
            ->add('familyContact')
            ->add('culture')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('zip')
            ->add('city')
            ->add('country')
            ->add('npai')
            ->add('email')
            ->add('emailNpai')
            ->add('emailNoNewsletter')
            ->add('vcardUid')
            ->add('confirmed')
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
            ->add('id')
            ->add('firstname')
            ->add('shortname')
            ->add('title')
            ->add('flashOnControl')
            ->add('password')
            ->add('familyContact')
            ->add('culture')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('zip')
            ->add('city')
            ->add('country')
            ->add('npai')
            ->add('email')
            ->add('emailNpai')
            ->add('emailNoNewsletter')
            ->add('vcardUid')
            ->add('confirmed')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('firstname')
            ->add('shortname')
            ->add('title')
            ->add('flashOnControl')
            ->add('password')
            ->add('familyContact')
            ->add('culture')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('zip')
            ->add('city')
            ->add('country')
            ->add('npai')
            ->add('email')
            ->add('emailNpai')
            ->add('emailNoNewsletter')
            ->add('vcardUid')
            ->add('confirmed')
        ;
    }
}
