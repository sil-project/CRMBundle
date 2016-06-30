<?php

namespace Librinfo\CRMBundle\Admin;

use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Form\FormMapper;
use Librinfo\CoreBundle\Admin\Traits\HandlesRelationsAdmin;
use Librinfo\CRMBundle\Entity\Organism;

class OrganismAdminConcrete extends OrganismAdmin
{
    use HandlesRelationsAdmin;

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('LibrinfoCRMBundle:Form:form_admin_fields.html.twig')
        );
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('generateCustomerCode'); // generateCustomerCodeAction in CRUD controler
        $collection->add('generateSupplierCode'); // generateCustomerCodeAction in CRUD controler
    }

    /**
     * @param FormMapper $mapper
     */
    protected function configureFormFields(FormMapper $mapper)
    {
        // HandlesRelationsAdmin::configureFormFields
        $this->configureFields(__FUNCTION__, $mapper, $this->getGrandParentClass());

        // relationships that will be handled by CollectionsManager
        $type = 'sonata_type_collection';

        foreach ($this->formFieldDescriptions as $fieldname => $fieldDescription)
            if ($fieldDescription->getType() == $type)
                $this->addManagedCollections($fieldname);

        // relationships that will be handled by ManyToManyManager
        foreach ($this->formFieldDescriptions as $fieldname => $fieldDescription)
        {
            $mapping = $fieldDescription->getAssociationMapping();
            if ($mapping['type'] == ClassMetadataInfo::MANY_TO_MANY && !$mapping['isOwningSide'])
                $this->addManyToManyCollections($fieldname);
        }
        // END HandlesRelationsAdmin::configureFormFields

        $subject = $this->getSubject();
        if ( $subject->isNew() ) {
            $mapper->removeGroup('', 'form_group_contacts', true);
        }
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

//        $errorElement
//            ->with('name')
//                ->assertLength(array('max' => 32))
//            ->end()
//        ;
    }

    /**
     * Customer code validator
     *
     * @param ErrorElement $errorElement
     * @param Organism $object
     */
    public function validateCustomerCode(ErrorElement $errorElement, $object) {
        $is_new = empty($object->getId());
        $code = $object->getCustomerCode();

        if ( empty($code) && $object->isCustomer() ) {
            $errorElement
                ->with('customerCode')
                    ->addViolation('A customer code is required for customers')
                ->end()
            ;
        }

        $regexp = sprintf('/^%s(\d{%d})$/', Organism::CC_PREFIX, Organism::CC_LENGTH);
        if ( !empty($code) && !preg_match($regexp, $code) ) {
            $msg = 'Wrong format for supplier code. It shoud be: ';
            $msg .= Organism::CC_PREFIX ? '%prefix% + %length% digits' : '%length% digits';
            $params = ['%prefix%' => Organism::CC_PREFIX, '%length%' => Organism::CC_LENGTH];
            dump($msg, $params);
            $errorElement
                ->with('customerCode')
                    ->addViolation($msg, $params)
                ->end()
            ;
        }

        if ( !empty($code) ) {
            $valid = true;
            $organisms = $this->getModelManager()->findBy(
                 'Librinfo\CRMBundle\Entity\Organism',
                 ['customerCode' => $code]
             );
            if ( $organisms ) {
                if ( $is_new )
                    $valid = false;
                else foreach ( $organisms as $organism ) if ( $organism->getId() != $object->getId() ) {
                    $valid = false;
                    break;
                }
            }
            if ( !$valid )
                $errorElement
                    ->with('customerCode')
                        ->addViolation('This customer code is already in use')
                    ->end()
                ;
        }

    }


    /**
     * Supplier code validator
     *
     * @param ErrorElement $errorElement
     * @param Organism $object
     */
    public function validateSupplierCode(ErrorElement $errorElement, $object) {
        $is_new = empty($object->getId());
        $code = $object->getSupplierCode();

        if ( empty($code) && $object->isSupplier() ) {
            $errorElement
                ->with('supplierCode')
                    ->addViolation('A supplier code is required for suppliers')
                ->end()
            ;
        }

        $regexp = sprintf('/^%s(\d{%d})$/', Organism::SC_PREFIX, Organism::SC_LENGTH);
        if ( !empty($code) && !preg_match($regexp, $code) ) {
            $msg = 'Wrong format for supplier code. It shoud be: ';
            $msg .= Organism::SC_PREFIX ? '%prefix% + %length% digits' : '%length% digits';
            $params = ['%prefix%' => Organism::SC_PREFIX, '%length%' => Organism::SC_LENGTH];
            $errorElement
                ->with('supplierCode')
                    ->addViolation($msg, $params)
                ->end()
            ;
        }

        if ( !empty($code) ) {
            $valid = true;
            $organisms = $this->getModelManager()->findBy(
                 'Librinfo\CRMBundle\Entity\Organism',
                 ['supplierCode' => $code]
             );
            if ( $organisms ) {
                if ( $is_new )
                    $valid = false;
                else foreach ( $organisms as $organism ) if ( $organism->getId() != $object->getId() ) {
                    $valid = false;
                    break;
                }
            }
            if ( !$valid )
                $errorElement
                    ->with('supplierCode')
                        ->addViolation('This supplier code is already in use')
                    ->end()
                ;
        }

    }

}
