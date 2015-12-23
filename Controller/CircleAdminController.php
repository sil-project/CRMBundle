<?php

namespace Librinfo\CRMBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

class CircleAdminController extends CRUDController
{
    
    /**
     * To keep backwards compatibility with older Sonata Admin code.
     *
     * @internal
     */
    private function resolveRequest(Request $request = null)
    {
        if (null === $request) {
            return $this->getRequest();
        }

        return $request;
    }    
}
