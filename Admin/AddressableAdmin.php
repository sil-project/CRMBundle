<?php

namespace Librinfo\CRMBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Librinfo\CRMBundle\Admin\TraceableAdmin;

abstract class AddressableAdmin extends TraceableAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('General')
                ->with('')
                    ->add('name')
                    ->add('email')
                ->end()
                ->with('Address')
                    ->add('address', 'textarea')
                    ->add('postalcode')
                    ->add('city')
                    ->add('country')
                ->end()
            ->end()
            ->tab('Ticketting')
            ->end()
            ->tab('Specifics')
                ->with('Communication')
                    ->add('description')
                ->end()
                ->with('Email')
                    ->add('emailNpai')
                    ->add('emailNoNewsletter')
                ->end()
                ->with('Address')
                    ->add('npai')
                ->end()
            ->end()
            ->tab('Internals')
                ->with('Automatic')
                    ->add('automatic')
                    ->add('user_id')
                ->end()
            ->end()
        ;
    }
}

