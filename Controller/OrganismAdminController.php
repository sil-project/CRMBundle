<?php

namespace Librinfo\CRMBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Librinfo\CRMBundle\Entity\Organism;

class OrganismAdminController extends CRUDController
{

    /**
     * generate a customerCode
     */
    public function generateCustomerCodeAction()
    {
        $em = $this->admin->getModelManager()->getEntityManager(Organism::class);
        $repo = $em->getRepository(Organism::class);

        $code = $repo->generateCustomerCode();

        return new JsonResponse(['customer_code' => $code]);
    }

    /**
     * generate a supplierCode
     */
    public function generateSupplierCodeAction()
    {
        $em = $this->admin->getModelManager()->getEntityManager(Organism::class);
        $repo = $em->getRepository(Organism::class);

        $code = $repo->generateSupplierCode();

        return new JsonResponse(['supplier_code' => $code]);
    }
}
