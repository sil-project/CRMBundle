<?php

namespace Librinfo\CRMBundle\Admin;

use Librinfo\CoreBundle\Admin\CoreAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Librinfo\CoreBundle\Admin\Traits\ManyToManyManager;

class CircleAdmin extends CoreAdmin
{
    use ManyToManyManager;
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('createdAt')
            ->add('updatedAt')
            ->add('name')
            ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->add('createdAt')
                ->add('updatedAt')
                ->add('name')
                ->add('id')
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
        $contactFieldOptions = array(
            'by_reference' => false,
            //'allow_delete' => true,
        );

        $formMapper
            ->add('name')
//            ->add('contacts', null, $contactFieldOptions)
            ->add('contacts', 'sonata_type_model_autocomplete', array(
                'by_reference' => false,
                'property' => 'name',
                'multiple' => true,
                'required' => false,
            ))
//            ->add('contacts', 'sonata_type_admin', $contactFieldOptions)  // suggests sonata_model_list !?!?
//            ->add('contacts', 'sonata_type_model', $contactFieldOptions)    // not implemented ?!?!
//            ->add('contacts', 'sonata_type_model_list', $contactFieldOptions)
//            ->add('contacts', 'sonata_type_collection', $contactFieldOptions)
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('createdAt')
            ->add('updatedAt')
            ->add('name')
            ->add('id')
        ;
    }
}
