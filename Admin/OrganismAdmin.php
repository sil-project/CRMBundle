<?php

/*
 * Copyright (C) 2015-2016 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Librinfo\CRMBundle\Admin;

use Blast\CoreBundle\Admin\CoreAdmin;
use Doctrine\DBAL\Query\QueryBuilder;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

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
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $object = parent::getNewInstance();
        return $object;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string $alias
     * @param string $field
     * @param array $value
     */
    public static function contactFilterQueryBuilder(ProxyQueryInterface $queryBuilder, $alias, $field, $value)
    {
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
