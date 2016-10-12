<?php

namespace Librinfo\CRMBundle\Entity\Repository;

use Librinfo\DoctrineBundle\Entity\Repository\TreeableRepository;

class CategoryRepository extends TreeableRepository
{
    /**
     * Returns the tree for the form widget
     *
     * @param string $rootAlias
     * @return array
     */
    public function getFormTree($rootAlias = 't')
    {
        $all = $this->createQueryBuilder($rootAlias)
            ->andWhere($rootAlias.'.materializedPath NOT LIKE :pattern')
            ->addOrderBy($rootAlias.'.sortMaterializedPath', 'ASC')
            ->setParameter('pattern', '/%/%')  # max level = 1
            ->getQuery()
            ->execute()
        ;

        $allRootNodes = array();
        foreach ($all as $node) if ($node->isRootNode()) {
            $allRootNodes[] = $node;
            break;
        }
        foreach ($allRootNodes as $root)
            $root->buildTree($all);

        return $allRootNodes;
    }

    public function getOrCreateRootNode()
    {
        $root_nodes = $this->getRootNodes();
        if ( count($root_nodes) > 0 )
            return $root_nodes[0];

        $root = new \Librinfo\VarietiesBundle\Entity\PlantCategory;
        $root->setName('_ROOT_');
        $root->setMaterializedPath('');
        $root->setSortMaterializedPath('');
        $em = $this->getEntityManager();
        $em->persist($root);
        $em->flush();
        return $root;
    }

    public function getAllWithoutRootQB($rootAlias = 't')
    {
        $qb = $this->createQueryBuilder($rootAlias)
                ->andWhere("$rootAlias.name != :root_name")
                ->setParameter(':root_name', '_ROOT_');
        return $qb;
    }
}