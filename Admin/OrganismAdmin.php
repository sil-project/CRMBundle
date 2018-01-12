<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Admin;

use Blast\Bundle\CoreBundle\Admin\CoreAdmin;
use Blast\Bundle\CoreBundle\Admin\Traits\HandlesRelationsAdmin;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sil\Bundle\CRMBundle\Entity\Organism;
use Sil\Bundle\CRMBundle\Form\DataTransformer\CustomerCodeTransformer;
use Sil\Bundle\CRMBundle\Form\DataTransformer\SupplierCodeTransformer;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Show\ShowMapper;

class OrganismAdmin extends CoreAdmin
{
    use HandlesRelationsAdmin;

    /**
     * @var string
     */
    protected $translationLabelPrefix = 'sil.crm.organism';

    protected $baseRouteName = 'admin_crm_organism';
    protected $baseRoutePattern = 'crm/organism';

    public function createQuery($context = 'list')
    {
        $proxyQuery = parent::createQuery('list');

        $qb = $proxyQuery->getQueryBuilder();

        $request = $this->getRequest();

        $filters = $request->query->get('filter', null);
        $currentsort = $filters['_sort_by'];
        $currentsortOrder = $filters['_sort_order'];

        if ($currentsort === null || $currentsort === 'name') {
            $currentsortOrder = ($currentsortOrder === null ? 'ASC' : $currentsortOrder);

            $qb->orderBy('CONCAT_WS(\'_\', o.firstname,o.lastname,o.name)', $currentsortOrder);
        }

        return $proxyQuery;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);

        // xxxxxxxAction in CRUD controller
        $collection->add('validateVat');
        $collection->add('set_default_address', 'set-default-address/{organismId}/{addressId}');
        $collection->add('set_default_phone', 'set-default-phone/{organismId}/{phoneId}');
        $collection->add('generateFakeEmail');
    }

    /**
     * @param FormMapper $mapper
     */
    protected function configureFormFields(FormMapper $mapper)
    {
        parent::configureFormFields($mapper);
        $subject = $this->getSubject();

        if ($subject->getId()) {
            $mapper->get('customerCode')->addViewTransformer(new CustomerCodeTransformer());
            $mapper->get('supplierCode')->addViewTransformer(new SupplierCodeTransformer());

            $mapper->remove('isIndividual');
            if ($subject->isIndividual()) {
                $mapper->remove('name');
                $mapper->remove('individuals');
                $this->renameFormTab('form_tab_individuals', 'form_tab_organizations');
                $formTabs = $this->getFormTabs();
                $formTabs['form_tab_organizations']['class'] = $formTabs['form_tab_organizations']['class'] . ' countable-tab count-organizations';
                $mapper->add('isIndividual_1', 'hidden', [
                    'mapped' => false,
                ]);
                $mapper->get('isIndividual_1')->setData('1');
            } else {
                $mapper->remove('title');
                $mapper->remove('firstname');
                $mapper->remove('lastname');
                $mapper->remove('organizations');
                $formTabs = $this->getFormTabs();
                $formTabs['form_tab_individuals']['class'] = $formTabs['form_tab_individuals']['class'] . ' countable-tab count-individuals';
                $mapper->add('isIndividual_0', 'hidden', [
                    'mapped' => false,
                ]);
                $mapper->get('isIndividual_0')->setData('0');
            }

            $this->setFormTabs($formTabs);
        }
    }

    /**
     * @param ShowMapper $mapper
     */
    protected function configureShowFields(ShowMapper $mapper)
    {
        parent::configureShowFields($mapper);
        $subject = $this->getSubject();

        if ($subject) {
            if ($subject->isIndividual()) {
                $mapper->remove('name');
                $mapper->remove('individuals');
                $this->renameShowTab('show_tab_individuals', 'show_tab_organizations');
                $showTabs = $this->getShowTabs();
                $showTabs['show_tab_organizations']['label'] = 'show_tab_organizations';
                $showTabs['show_tab_organizations']['name'] = 'show_tab_organizations';
                $showTabs['show_tab_organizations']['class'] = $showTabs['show_tab_organizations']['class'] . ' countable-tab count-organizations';
            } else {
                $mapper->remove('title');
                $mapper->remove('firstname');
                $mapper->remove('lastname');
                $mapper->remove('organizations');
                $showTabs = $this->getShowTabs();
                $showTabs['show_tab_individuals']['class'] = $showTabs['show_tab_individuals']['class'] . ' countable-tab count-individuals';
            }

            $this->setShowTabs($showTabs);
        }
    }

    public function preUpdate($object)
    {
        parent::preUpdate($object);
        $this->handlePositions($object);
    }

    public function prePersist($object)
    {
        parent::prePersist($object);
        $this->handlePositions($object);
    }

    /**
     * @param Organism $organism
     */
    public function preRemove($organism)
    {
        foreach ($organism->getIndividuals() as $position) {
            $this->getModelManager()->delete($position);
        }

        foreach ($organism->getOrganizations() as $position) {
            $this->getModelManager()->delete($position);
        }

        foreach ($organism->getPhones() as $phone) {
            $this->getModelManager()->delete($phone);
        }

        foreach ($organism->getAddresses() as $address) {
            $this->getModelManager()->delete($address);
        }

        parent::preRemove($organism);
    }

    public function preBatchAction($actionName, ProxyQueryInterface $query, array &$idx, $allElements)
    {
        parent::preBatchAction($actionName, $query, $idx, $allElements);
    }

    /**
     * @param ErrorElement $errorElement
     * @param mixed        $object
     *
     * @deprecated this feature cannot be stable, use a custom validator,
     *             the feature will be removed with Symfony 2.2
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $this->validateCustomerCode($errorElement, $object);
        $this->validateSupplierCode($errorElement, $object);
        $this->validateMandatoryFields($errorElement, $object);
    }

    /**
     * Customer code validator.
     *
     * @param ErrorElement $errorElement
     * @param Organism     $object
     */
    public function validateCustomerCode(ErrorElement $errorElement, $object)
    {
        $is_new = empty($object->getId());
        $code = $object->getCustomerCode();

        if (empty($code) && $object->isCustomer() && !$is_new) {
            $errorElement
                ->with('customerCode')
                    ->addViolation('A customer code is required for customers')
                ->end()
            ;
        }

        $registry = $this->getConfigurationPool()->getContainer()->get('blast_core.code_generators');
        $codeGenerator = $registry->getCodeGenerator($this->getClass(), 'customerCode');
        if (!empty($code) && !$codeGenerator->validate($code)) {
            $msg = 'Wrong format for customer code. It shoud be: ' . $codeGenerator::getHelp();
            $errorElement
                ->with('customerCode')
                    ->addViolation($msg)
                ->end()
            ;
        }

        if (!empty($code)) {
            $valid = true;
            $organisms = $this->getModelManager()->findBy(
                $this->getClass(),
                ['customerCode' => $code]
             );
            if ($organisms) {
                if ($is_new) {
                    $valid = false;
                } else {
                    foreach ($organisms as $organism) {
                        if ($organism->getId() != $object->getId()) {
                            $valid = false;
                            break;
                        }
                    }
                }
            }
            if (!$valid) {
                $errorElement
                    ->with('customerCode')
                        ->addViolation('This customer code is already in use')
                    ->end()
                ;
            }
        }
    }

    /**
     * Supplier code validator.
     *
     * @param ErrorElement $errorElement
     * @param Organism     $object
     */
    public function validateSupplierCode(ErrorElement $errorElement, $object)
    {
        $is_new = empty($object->getId());
        $code = $object->getSupplierCode();

        if (empty($code) && $object->isSupplier() && !$is_new) {
            $errorElement
                ->with('supplierCode')
                    ->addViolation('A supplier code is required for suppliers')
                ->end()
            ;
        }

        $registry = $this->getConfigurationPool()->getContainer()->get('blast_core.code_generators');
        $codeGenerator = $registry->getCodeGenerator($this->getClass(), 'supplierCode');
        if (!empty($code) && !$codeGenerator->validate($code)) {
            $msg = 'Wrong format for supplier code. It shoud be: ' . $codeGenerator::getHelp();
            $errorElement
                ->with('supplierCode')
                    ->addViolation($msg)
                ->end()
            ;
        }

        if (!empty($code)) {
            $valid = true;
            $organisms = $this->getModelManager()->findBy(
                $this->getClass(),
                ['supplierCode' => $code]
             );
            if ($organisms) {
                if ($is_new) {
                    $valid = false;
                } else {
                    foreach ($organisms as $organism) {
                        if ($organism->getId() != $object->getId()) {
                            $valid = false;
                            break;
                        }
                    }
                }
            }
            if (!$valid) {
                $errorElement
                    ->with('supplierCode')
                        ->addViolation('This supplier code is already in use')
                    ->end()
                ;
            }
        }
    }

    public function validateMandatoryFields(ErrorElement $errorElement, $object)
    {
        if ($object) {
            if ($object->isIndividual()) {
                $errorElement
                    ->with('title')
                        ->assertNotBlank()
                    ->end()
                    ->with('firstname')
                        ->assertNotBlank()
                    ->end()
                    ->with('lastname')
                        ->assertNotBlank()
                    ->end()
                ;
            } else {
                $errorElement
                    ->with('name')
                        ->assertNotBlank()
                    ->end()
                ;
            }
            $other = $this->modelManager->findOneBy($this->getClass(), array('email' => $object->getEmail()));

            if (null !== $other && !$other->getId() == $object->getId()) {
                $errorElement
                   ->with('email')
                        ->addViolation('The email must be unique!')
                   ->end()
               ;
            }
        }
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $alias
     * @param string       $field
     * @param array        $value
     */
    public static function contactFilterQueryBuilder(ProxyQueryInterface $queryBuilder, $alias, $field, $value)
    {
        if (!$value['value']) {
            return;
        }

        $search = '%' . $value['value'] . '%';
        $queryBuilder
            ->andWhere($queryBuilder->expr()->orX(
                $queryBuilder->expr()->like("$alias.firstname", ':firstname'),
                $queryBuilder->expr()->like("$alias.name", ':name')
            ))
            ->setParameter('firstname', $search)
            ->setParameter('name', $search)
        ;

        return true;
    }

    private function handlePositions($object)
    {
        if ($object->isIndividual()) {
            if ($object->getOrganizations() && $object->getOrganizations()->count() > 0) {
                foreach ($object->getOrganizations() as $org) {
                    $org->setIndividual($object);
                }
            }
        } else {
            if ($object->getIndividuals() && $object->getIndividuals()->count() > 0) {
                foreach ($object->getIndividuals() as $ind) {
                    $ind->setOrganization($object);
                }
            }
        }
    }

    public function getExportFields()
    {
        // @TODO: This export must be done outside sonata

        return [
            'name',
            'alert',
            'email',
            'url',
            'description',
            'createdAt',
            'updatedAt',
            'emailNpai',
            'emailNoNewsletter',
            'category',
        ];
    }
}
