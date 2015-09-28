<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

abstract class TraceableAdmin extends Admin
{
    protected function orderFields($mapper)
    {
        $order = array(
            'id',
            'title',
            'name',
            'firstname',
            'shortname',
            'email',
            'address',
            'postalcode',
            'city',
            'country',
            'description',
            'culture',
            'familyContact',
            'npai',
            'emailNpai',
            'flashOnControl',
        );
        foreach ( $order as $key => $field )
        if ( !$mapper->has($field) )
            unset($order[$key]);
        $mapper->reorder($order);
        
        return $this;
    }
    
    protected function removeInternalFields($mapper)
    {
        $remove = array(
            'id',
            'user_id',
            'automatic',
            'vcardUid',
            'confirmed',
            'password',
        );
        foreach ( $remove as $key => $field )
        if ( $mapper->has($field) )
            $mapper->remove($field);
        
        // specific removals
        if ( $mapper instanceof DatagridMapper )
        {
            $remove = array(
                'address',
                'description',
                'flashOnControl',
            );
            foreach ( $remove as $key => $field )
            if ( $mapper->has($field) )
                $mapper->remove($field);
        }
        
        return $this;
    }
    
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
}
