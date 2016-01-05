<?php

namespace Librinfo\CRMBundle\Admin;

use Librinfo\CoreBundle\Admin\Traits\Base as BaseAdmin;

class CircleAdminConcrete extends CircleAdmin
{
    use BaseAdmin;

    /**
     * {@inheritdoc}
     */
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        if ($user->isSuperAdmin())
            return $query;

        // we add 3 conditions :
        // 1. the Circle has no Owner and no Users
        // 2. ... OR the current user is the Circle owner
        // 3. ... OR the current user belongs to the circle users

        $ra = $query->getRootAliases()[0];
        $expr = $query->expr();

        // 1. the Circle has no Owner and no Users...
        $subquery1 = $query->getEntityManager()->createQueryBuilder()
                ->select('u1.id')
                ->from('Librinfo\CRMBundle\Entity\Circle', 'c1')
                ->join('c1.users',  'u1')
                ->where($expr->eq('c1', $ra));
        $dql1 = $expr->andX(
                $expr->isNull($ra.'.owner'),
                $expr->not($expr->exists($subquery1->getDql()))
        );

        // 2. the current user is the Circle owner
        $dql2 = $expr->eq($ra.".owner", ':user2');

        // 3. the current user belongs to the circle users
        $subquery3 = $query->getEntityManager()->createQueryBuilder()
                ->select('c3.id')
                ->from('Librinfo\CRMBundle\Entity\Circle', 'c3')
                ->join('c3.users',  'u3')
                ->where($expr->eq('u3', ':user3'))
                ->andWhere($expr->eq('c3', $ra));
        $dql3 = $expr->exists($subquery3->getDql());

        $query->andWhere($expr->orX(
                $dql1,
                $dql2,
                $dql3
        ));
        $query->setParameter('user2', $user);
        $query->setParameter('user3', $user);

        return $query;
    }
}

