<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Admin;

use Blast\Bundle\CoreBundle\Admin\CoreAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CityAdmin extends CoreAdmin
{
    protected $datagridValues = array(
        '_page'       => 1,
        '_sort_order' => 'ASC',
        '_sort_by'    => 'zip',
    );

    protected function configureRoutes(RouteCollection $collection)
    {
        // xxxxxxxAction in CRUD controller
        $collection->add('getAddressAutocompleteItems');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
//            ->add('zip', 'doctrine_orm_callback', array(
//                'callback' => function($queryBuilder, $alias, $field, $value) {
//                    if (empty($value['value'])) {
//                        return;
//                    }
//                    $queryBuilder->andWhere($alias . '.city LIKE :city');
//                    $queryBuilder->setParameter('city', '%Paris%');
//                    dump($queryBuilder->getQuery()->getSql());
//                    return true;
//                },
//                'field_type' => 'text'
//            ))
            ->add('zip')
            ->add('city')
            ->add('country_code')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('zip')
            ->add('city')
            ->add('country_code')
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('zip')
            ->add('city')
            ->add('country_code')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('zip')
            ->add('city')
            ->add('country_code')
        ;
    }
}
