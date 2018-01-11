<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Controller;

use Blast\Bundle\CoreBundle\Controller\CRUDController;
use Sil\Bundle\CRMBundle\Entity\Organism;
use Sil\Bundle\CRMBundle\Entity\OrganismPhone;
use Sil\Bundle\CRMBundle\Entity\AddressInterface;
use Sil\Bundle\CRMBundle\Entity\OrganismInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sparkling\VATBundle\Exception\InvalidCountryCodeException;
use Sparkling\VATBundle\Exception\VATException;

class OrganismAdminController extends CRUDController
{
    /**
     * generate a customerCode.
     */
    public function generateCustomerCodeAction()
    {
        $em = $this->admin->getModelManager()->getEntityManager(Organism::class);
        $repo = $em->getRepository(Organism::class);

        $code = $repo->generateCustomerCode();

        return new JsonResponse(['customer_code' => $code]);
    }

    /**
     * validate a VAT number.
     */
    public function validateVatAction(Request $request)
    {
        $vat = str_replace(' ', '', $request->query->get('vat'));
        $vatService = $this->get('vat.service');
        $translator = $this->get('translator');

        try {
            $valid = $vatService->validate($vat);
            $msg = $valid ? '' : $translator->trans('Not a valid VAT number');
        } catch (InvalidCountryCodeException $exc) {
            $valid = false;
            $msg = $translator->trans('The countrycode is not valid. It must be one of %country_codes%', ['%country_codes%' => implode(', ', $vatService::$validCountries)]);
        } catch (VATException $exc) {
            $valid = false;
            $msg = $translator->trans('The VAT number is not valid. It must be in format [0-9A-Za-z\+\*\.]{4,14}');
        } catch (\Exception $exc) {
            $valid = false;
            $msg = $translator->trans($exc->getMessage());
        }

        return new JsonResponse(['valid' => $valid, 'vat' => $vat, 'msg' => $msg]);
    }

    /**
     * @param Request $request
     * @param mixed   $object
     *
     * @return Response|null
     */
    protected function preEdit(Request $request, $object)
    {
        if ($this->admin instanceof \Sil\Bundle\CRMBundle\Admin\CustomerAdmin && !$object->isCustomer()) {
            throw new NotFoundHttpException();
        }
    }

    /**
     * @param Request $request
     * @param mixed   $object
     *
     * @return Response|null
     */
    protected function preShow(Request $request, $object)
    {
        if ($this->admin instanceof \Sil\Bundle\CRMBundle\Admin\CustomerAdmin && !$object->isCustomer()) {
            throw new NotFoundHttpException();
        }
    }

    public function setDefaultAddressAction($organismId, $addressId)
    {
        $manager = $this->getDoctrine()->getManager();
        $organism = $manager->getRepository(OrganismInterface::class)->find($organismId);
        $address = $manager->getRepository(AddressInterface::class)->find($addressId);

        if ($organism->getAddresses()->contains($address)) {
            $organism->setDefaultAddress($address);
            $manager->flush();
        }

        $referer = $this->getRequest()->headers->get('referer');

        return new RedirectResponse($referer);
    }

    public function setDefaultPhoneAction($organismId, $phoneId)
    {
        $manager = $this->getDoctrine()->getManager();
        $organism = $manager->getRepository(OrganismInterface::class)->find($organismId);
        $phone = $manager->getRepository(OrganismPhone::class)->find($phoneId);

        if ($organism->hasPhone($phone)) {
            $organism->setDefaultPhone($phone);
            $phone->setOrganism($organism);
            $manager->persist($organism);
            $manager->persist($phone);
            $manager->flush();
        }

        $referer = $this->getRequest()->headers->get('referer');

        return new RedirectResponse($referer);
    }

    public function generateFakeEmailAction(Request $request)
    {
        $fakeEmailParameters = $this->getParameter('sil.fake_email', 'fake.email');
        $emailDomain = $fakeEmailParameters['domain'] ?: 'fake.email';
        $emailPrefix = $fakeEmailParameters['prefix'] ?: 'fake_';
        $emailSuffix = $fakeEmailParameters['suffix'] ?: '';

        $uniqueChain = time();

        $email = sprintf(
            '%1$s%4$s%2$s@%3$s',
            $emailPrefix,
            $emailSuffix,
            $emailDomain,
            $uniqueChain
        );

        return new JsonResponse(['email' => $email]);
    }
}
