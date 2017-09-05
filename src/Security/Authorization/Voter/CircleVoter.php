<?php

/*
 * This file is part of the Blast Project package.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Librinfo\CRMBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
//use Librinfo\SonataSyliusUserBundle\Entity\SonataUser; There should be no dependency to SonataSyliusUserBundle
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Librinfo\CRMBundle\Entity\Circle;

class CircleVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';

    public function supports($attribute, $subject)
    {
        return $subject instanceof Circle && in_array($attribute, array(
            self::VIEW, self::EDIT,
        ));
    }

    protected function voteOnAttribute($attribute, $circle, TokenInterface $token)
    {
        $user = $token->getUser();

        // make sure there is a user object (i.e. that the user is logged in)
        if (!$user instanceof UserInterface) {
            return false;
        }

        // double-check that the User object is the expected entity (this
        // only happens when you did not configure the security system properly)
        // TODO: there should be no dependency to the SonataSyliusUserBundle
//        if ( !$user instanceof SonataUser )
//        {
//            throw new \LogicException('The user is somehow not our SonataUser class!');
//        }

        if ($user->hasRole('ROLE_SUPER_ADMIN') || $circle->isAccessibleBy($user)) {
            return true;
        }

        return false;
    }
}
