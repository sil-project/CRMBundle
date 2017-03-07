<?php

namespace Librinfo\CRMBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
//use Librinfo\UserBundle\Entity\User;
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
            self::VIEW, self::EDIT
        ));
    }

    
    protected function voteOnAttribute($attribute, $circle, TokenInterface $token)
    {
        $user = $token->getUser();
        
        // make sure there is a user object (i.e. that the user is logged in)
        if ( !$user instanceof UserInterface )
            return false;

        // double-check that the User object is the expected entity (this
        // only happens when you did not configure the security system properly)
//        if ( !$user instanceof User )
//        {
//            throw new \LogicException('The user is somehow not our User class!');
//        }
        
        if ( $user->hasRole('ROLE_SUPER_ADMIN') || $circle->isAccessibleBy($user))
            return true;

        return false;
    }

}
