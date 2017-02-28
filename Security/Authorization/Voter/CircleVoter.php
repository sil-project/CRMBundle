<?php

namespace Librinfo\CRMBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Librinfo\UserBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

class CircleVoter extends AbstractVoter
{

    const VIEW = 'view';
    const EDIT = 'edit';

    protected function getSupportedAttributes()
    {
        return array(self::VIEW, self::EDIT);
    }

    protected function getSupportedClasses()
    {
        return array('Librinfo\CRMBundle\Entity\Circle');
    }

    protected function isGranted($attribute, $circle, $user = null)
    {
        // make sure there is a user object (i.e. that the user is logged in)
        if ( !$user instanceof UserInterface )
        {
            return false;
        }

        // double-check that the User object is the expected entity (this
        // only happens when you did not configure the security system properly)
//        if ( !$user instanceof User )
//        {
//            throw new \LogicException('The user is somehow not our User class!');
//        }
        
        if ( $user->hasRole('ROLE_SUPER_ADMIN') )
        {
            return true;
        }

        switch ( $attribute ) {
            case self::VIEW:
                if ( $circle->isAccessibleBy($user) )
                {
                    return true;
                }
                break;
            case self::EDIT:
                if ( $circle->isAccessibleBy($user) )
                {
                    return true;
                }
                break;
        }

        return false;
    }

}
