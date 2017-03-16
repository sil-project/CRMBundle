<?php

namespace Librinfo\CRMBundle\Admin;

use Blast\CoreBundle\Admin\CoreAdmin;
use Blast\UtilsBundle\Form\Type\CustomChoiceType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class OrganismEmbeddedAdmin extends CoreAdmin
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
            ->add('title', CustomChoiceType::class, [
                'blast_choices' => ['Mr', 'Mrs'],
                'choices_field' => 'contact.title',
                'required' => false,
            ])
            ->add('firstname')
            ->add('name', 'text', ['required' => false])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
    }
}
