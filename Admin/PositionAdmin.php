<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Admin;

use Blast\Bundle\CoreBundle\Admin\CoreAdmin;
use Blast\Bundle\CoreBundle\Admin\Traits\EmbeddedAdmin;
use Blast\Bundle\DoctrinePgsqlBundle\Datagrid\ProxyQuery;

class PositionAdmin extends CoreAdmin
{
    use EmbeddedAdmin;

    /**
     * @var string
     */
    protected $translationLabelPrefix = 'sil.crm.position';

    protected $baseRouteName = 'admin_crm_position';
    protected $baseRoutePattern = 'crm/position';

    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $alias
     * @param string       $field
     * @param array        $value
     *
     * @todo this is the same as OrganismAdmin#contactFilterQueryBuilder. Unify ?
     */
    public static function contactFilterQueryBuilder(ProxyQuery $queryBuilder, $alias, $field, $value)
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

    public function individualsCallback($admin, $property, $value)
    {
        $datagrid = $admin->getDatagrid();
        $queryBuilder = $datagrid->getQuery();

        $queryBuilder
            ->andWhere('o.isIndividual = true');

        // @TODO: Refactor this callback
        // $searchHandler = $this->getConfigurationPool()->getContainer()->get('blast_base_entities.search_handler');
        // $searchHandler->handleEntity($admin->getModelManager()->getMetadata($admin->getClass()));
        // $queryBuilder = $searchHandler->alterSearchQueryBuilder($queryBuilder, $value);
    }

    public function organizationsCallback($admin, $property, $value)
    {
        $datagrid = $admin->getDatagrid();
        $queryBuilder = $datagrid->getQuery();

        $queryBuilder
            ->andWhere('o.isIndividual = false');

        // @TODO: Refactor this callback
        // $searchHandler = $this->getConfigurationPool()->getContainer()->get('blast_base_entities.search_handler');
        // $searchHandler->handleEntity($admin->getModelManager()->getMetadata($admin->getClass()));
        // $queryBuilder = $searchHandler->alterSearchQueryBuilder($queryBuilder, $value);
    }
}
