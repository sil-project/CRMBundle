<?php

namespace Librinfo\CRMBundle\Admin;


use Blast\CoreBundle\Admin\CoreAdmin;
use Blast\CoreBundle\Admin\Traits\EmbeddedAdmin;
use Blast\DoctrinePgsqlBundle\Datagrid\ProxyQuery;

class PositionAdmin extends CoreAdmin
{
    use EmbeddedAdmin;

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
    
    public static function individualsCallback($admin, $property, $value)
    {
        $searchIndex = $admin->getClass() . 'SearchIndex';
        $datagrid = $admin->getDatagrid();
        $queryBuilder = $datagrid->getQuery();
        $alias = $queryBuilder->getRootalias();

        $queryBuilder
            ->leftJoin($searchIndex, 's', 'WITH', $alias . '.id = s.object')
            ->where('s.keyword LIKE :value')
            ->andWhere("$alias.isIndividual = true")
            ->setParameter('value', "%$value%")
        ;
    }
    
    public static function organizationsCallback($admin, $property, $value)
    {
        $searchIndex = $admin->getClass() . 'SearchIndex';
        $datagrid = $admin->getDatagrid();
        $queryBuilder = $datagrid->getQuery();
        $alias = $queryBuilder->getRootalias();

        $queryBuilder
            ->leftJoin($searchIndex, 's', 'WITH', $alias . '.id = s.object')
            ->where('s.keyword LIKE :value')
            ->andWhere("$alias.isIndividual = false")
            ->setParameter('value', "%$value%")
        ;
    }
}
