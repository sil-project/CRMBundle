<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Form\Type;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Blast\Bundle\SearchBundle\Form\Type\AutocompleteType;

class ZipCityCountryType extends AutocompleteType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('city_field', 'city');
        $resolver->setDefault('zip_field', 'zip');
        $resolver->setDefault('country_field', 'country');

        $resolver->setDefault('use_city', true);
        $resolver->setDefault('use_zip', true);
        $resolver->setDefault('use_country', true);

        $resolver->setDefault('label_city', false);
        $resolver->setDefault('label_zip', false);
        $resolver->setDefault('label_country', false);

        $resolver->setDefault('compound', true);
        $resolver->setDefault('mapped', false);

        $resolver->setDefault('label', null);
        $resolver->setDefault('allow_new_values', true);
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);

        $allOptions = [
            'city_field',
            'zip_field',
            'country_field',

            'use_city',
            'use_zip',
            'use_country',

            'label_city',
            'label_zip',
            'label_country',
        ];

        foreach ($allOptions as $opt) {
            $view->vars[$opt] = $options[$opt];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        if ($options['use_city'] === true) {
            $builder->add($options['city_field'], TextType::class, []);
        }

        if ($options['use_zip'] === true) {
            $builder->add($options['zip_field'], TextType::class, []);
        }

        if ($options['use_country'] === true) {
            $builder->add($options['country_field'], CountryType::class, ['data'=>'FR']);
        }

        $this->addFieldDataMappingEventListener($builder, $options);
    }

    private function addFieldDataMappingEventListener($builder, $options)
    {
        $builder

            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) use ($builder, $options) {
                $form = $event->getForm();
                $parentForm = $form->getParent();
                $parentData = $parentForm->getData();

                if ($parentData !== null) {
                    $propertyAccessor = new PropertyAccessor();
                    if ($options['use_city'] === true) {
                        $value = $propertyAccessor->getValue($parentData, $options['city_field']);
                        $form->get($options['city_field'])->setData($value);
                    }
                    if ($options['use_zip'] === true) {
                        $value = $propertyAccessor->getValue($parentData, $options['zip_field']);
                        $form->get($options['zip_field'])->setData($value);
                    }
                }

                $event->stopPropagation();
            })

            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($builder, $options) {
                $parentForm = $event->getForm()->getParent();
                $parentData = $parentForm->getData();

                $propertyAccessor = new PropertyAccessor();
                if ($options['use_city'] === true) {
                    $value = $event->getData()[$options['city_field']];
                    $propertyAccessor->setValue($parentData, $options['city_field'], $value);
                }
                if ($options['use_zip'] === true) {
                    $value = $event->getData()[$options['zip_field']];
                    $propertyAccessor->setValue($parentData, $options['zip_field'], $value);
                }
            })
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sil_crm_zip_city_country_autocomplete';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
