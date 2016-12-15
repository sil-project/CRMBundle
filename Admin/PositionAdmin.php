<?php

namespace Librinfo\CRMBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Blast\CoreBundle\Admin\CoreAdmin;
use Blast\DoctrinePgsqlBundle\Datagrid\ProxyQuery;

class PositionAdmin extends CoreAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('email')
            ->add('phone')
            ->add('description')
            ->add('department')
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
            ->add('email')
            ->add('phone')
            ->add('description')
            ->add('department')
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
        $formMapper
            ->add('email')
            ->add('phone')
            ->add('description')
            ->add('department')
            ->add('name')
            ->add('id')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('email')
            ->add('phone')
            ->add('description')
            ->add('department')
            ->add('name')
            ->add('id')
        ;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string $alias
     * @param string $field
     * @param array $value
     *
     * @todo this is the same as OrganismAdmin#contactFilterQueryBuilder. Unify ?
     */
    public static function contactFilterQueryBuilder(ProxyQuery $queryBuilder, $alias, $field, $value)
    {
        if ( !$value['value'] ) 
            return;

        $search = '%' . $value['value'] . '%';
        $queryBuilder
            ->andWhere($queryBuilder->expr()->orX(
                $queryBuilder->expr()->like("$alias.firstname", ':firstname'),
                $queryBuilder->expr()->like("$alias.name", ':name')
            ))
            ->setParameter('firstname', $search)
            ->setParameter('name', $search)
        ;
        return true;
    }
}
