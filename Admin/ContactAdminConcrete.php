<?php

namespace Librinfo\CRMBundle\Admin;

use Librinfo\CoreBundle\Admin\Traits\HandlesRelationsAdmin;
use Librinfo\BaseEntitiesBundle\Entity\Repository\SearchableRepository;
use Sonata\AdminBundle\Filter\FilterInterface;

class ContactAdminConcrete extends ContactAdmin
{
    use HandlesRelationsAdmin;

    public static function indexSearch($targetAdmin, $property, $searchText) {
        dump($property, $searchText);
        $datagrid = $targetAdmin->getDatagrid();
        $filter = $datagrid->getFilter('name');
        $filter->setCondition(FilterInterface::CONDITION_OR);
        $datagrid->setValue('name', null, $searchText);
        $datagrid->setValue('name', null, 'TATA');

        $class = $targetAdmin->getClass();
        dump($class);
        $em = $targetAdmin->getModelManager()->getEntityManager($class);
        $classMetadata = $em->getClassMetadata($class);
        $repo = new SearchableRepository($em, $classMetadata);
        $results = $repo->indexSearch('bez');
        dump(($results[0][0]->getName()));
    }
}

