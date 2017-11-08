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

namespace Sil\Bundle\CRMBundle\Controller;

use Blast\Bundle\CoreBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CircleAdminController extends CRUDController
{
    /**
     * This method is called from editAction.
     *
     * @param Request $request
     * @param mixed   $object
     *
     * @return Response|null
     */
    protected function preEdit(Request $request, $object)
    {
        //        $this->denyAccessUnlessGranted('edit', $object, 'Unauthorized access!');
//        if (!$object->isEditable())
//            throw $this->createAccessDeniedException('Unauthorized access!');
    }

    /**
     * This method is called from showAction.
     *
     * @param Request $request
     * @param mixed   $object
     *
     * @return Response|null
     */
    protected function preShow(Request $request, $object)
    {
        //        $this->denyAccessUnlessGranted('view', $object, 'Unauthorized access!');
    }

    /**
     * This method is called from deleteAction.
     *
     * @param Request $request
     * @param mixed   $object
     *
     * @return Response|null
     */
    protected function preDelete(Request $request, $object)
    {
        //        $this->denyAccessUnlessGranted('edit', $object, 'Unauthorized access!');
//        if (!$object->isEditable())
//            throw $this->createAccessDeniedException('Unauthorized access!');
    }

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
