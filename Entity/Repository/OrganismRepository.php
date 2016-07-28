<?php

namespace Librinfo\CRMBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Librinfo\CRMBundle\Entity\Organism;

class OrganismRepository extends EntityRepository
{
    /**
     * Returns the nex Organism customerCode
     *
     * @return string
     */
    public function generateCustomerCode()
    {
        $regexp = sprintf('^%s(\d{%d})$', Organism::CC_PREFIX, Organism::CC_LENGTH);
        $res = $this->createQueryBuilder('c')
            ->select("SUBSTRING(c.customerCode, '$regexp') AS code")
            ->andWhere("SUBSTRING(c.customerCode, '$regexp') != ''")
            ->setMaxResults(1)
            ->addOrderBy('code', 'desc')
            ->getQuery()
            ->getScalarResult()
        ;
        $max = $res ? (int)$res[0]['code'] : 0;

        return sprintf("%s%0".Organism::CC_LENGTH."d", Organism::CC_PREFIX, $max + 1);
    }

    /**
     * Returns the nex Organism supplierCode
     *
     * @return string
     */
    public function generateSupplierCode()
    {
        $regexp = sprintf('^%s(\d{%d})$', Organism::SC_PREFIX, Organism::SC_LENGTH);
        $res = $this->createQueryBuilder('c')
            ->select("SUBSTRING(c.supplierCode, '$regexp') AS code")
            ->andWhere("SUBSTRING(c.supplierCode, '$regexp') != ''")
            ->setMaxResults(1)
            ->addOrderBy('code', 'desc')
            ->getQuery()
            ->getScalarResult()
        ;
        $max = $res ? (int)$res[0]['code'] : 0;

        return sprintf("%s%0".Organism::SC_LENGTH."d", Organism::SC_PREFIX, $max + 1);
    }

}