<?php

namespace Librinfo\CRMBundle\Admin;

use Doctrine\DBAL\Query\QueryBuilder;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Librinfo\CoreBundle\Admin\CoreAdmin;
use Librinfo\DoctrinePgsqlBundle\Datagrid\ProxyQuery;

class OrganismAdmin extends CoreAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('url')
            ->add('administrativeNumber');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
//            ->add('url')
//            ->add('administrativeNumber')
//            ->add('categories')
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
//        $formMapper
//            ->add('url')
//            ->add('administrativeNumber')
//            ->add('categories', 'librinfo_baseentities_treeablechoice', [
//                'class'       => 'LibrinfoCRMBundle:Category',
//                'required'    => false,
//                'empty_value' => '- - -',
//                'multiple'    => true
//            ]);
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('url')
            ->add('administrativeNumber')
            ->add('categories');
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string $alias
     * @param string $field
     * @param array $value
     */
    public static function contactFilterQueryBuilder(ProxyQuery $queryBuilder, $alias, $field, $value)
    {
        dump($queryBuilder, $alias, $field, $value);
        if (!$value['value']) {
            return;
        }

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
