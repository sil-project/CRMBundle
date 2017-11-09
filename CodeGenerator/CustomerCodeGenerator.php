<?php

/*
 * This file is part of the Sil Project.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\CodeGenerator;

use Doctrine\ORM\EntityManager;
use Blast\Bundle\CoreBundle\CodeGenerator\CodeGeneratorInterface;
use Sil\Bundle\CRMBundle\Entity\OrganismInterface;

class CustomerCodeGenerator implements CodeGeneratorInterface
{
    const ENTITY_CLASS = 'Sil\Bundle\CRMBundle\Entity\OrganismInterface';
    const ENTITY_FIELD = 'customerCode';

    /**
     * @var EntityManager
     */
    private static $em;

    // TODO: this should be in app configuration:
    public static $codePrefix = '';
    public static $codeLength = 6;

    public static function setEntityManager(EntityManager $em)
    {
        self::$em = $em;
    }

    /**
     * @param OrganismInterface $organism
     *
     * @return string
     */
    public static function generate($organism)
    {
        if ($organism->isCustomer()) {
            $repo = self::$em->getRepository(OrganismInterface::class);
            $regexp = sprintf('^%s(\d{%d})$', self::$codePrefix, self::$codeLength);
            $res = $repo->createQueryBuilder('c')
                ->select("SUBSTRING(c.customerCode, '$regexp') AS code")
                ->andWhere("SUBSTRING(c.customerCode, '$regexp') != ''")
                ->setMaxResults(1)
                ->addOrderBy('code', 'desc')
                ->getQuery()
                ->getScalarResult()
            ;
            $max = $res ? (int) $res[0]['code'] : 0;

            if ($organism->getCustomerCode() === null) {
                return sprintf('%s%0' . self::$codeLength . 'd', self::$codePrefix, $max + 1);
            } else {
                return $organism->getCustomerCode();
            }
        } else {
            return null;
        }
    }

    /**
     * @param string   $code
     * @param Organism $organism
     *
     * @return bool
     */
    public static function validate($code, $organism = null)
    {
        $regexp = sprintf('/^%s(\d{%d})$/', self::$codePrefix, self::$codeLength);

        return preg_match($regexp, $code);
    }

    /**
     * @return string
     */
    public static function getHelp()
    {
        return self::$codePrefix ? sprintf('%s + %d digits', self::$codePrefix, self::$codeLength)
            : sprintf('%d digits', self::$codeLength);
    }
}
