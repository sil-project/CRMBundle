<?php

namespace Librinfo\CRMBundle\Controller;

use Blast\CoreBundle\Controller\CRUDController;
use Librinfo\CRMBundle\Entity\Organism;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sparkling\VATBundle\Exception\InvalidCountryCodeException;
use Sparkling\VATBundle\Exception\InvalidVATNumberException;
use Sparkling\VATBundle\Exception\VATException;

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
     * validate a VAT number
     */
    public function validateVatAction(Request $request)
    {
        $vat = $request->query->get('vat');
        $vatService = $this->get('vat.service');
        $translator = $this->get('translator');

        try {
            $valid = $vatService->validate($vat);
            $msg = $valid ? '' : $translator->trans('Not a valid VAT number');
        } catch (InvalidCountryCodeException $exc) {
            $valid = false;
            $msg = $translator->trans('The countrycode is not valid. It must be one of %country_codes%', ['%country_codes%'=>implode(', ', $vatService::$validCountries)]);
        } catch (VATException $exc) {
            $valid = false;
            $msg = $translator->trans('The VAT number is not valid. It must be in format [0-9A-Za-z\+\*\.]{4,14}');
        } catch (\Exception $exc) {
            $valid = false;
            $msg = $translator->trans($exc->getMessage());
        }

        return new JsonResponse(['valid'=>$valid, 'vat'=>$vat, 'msg'=>$msg]);
    }
}
