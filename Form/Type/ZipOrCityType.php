<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Form\Type;

use Blast\Bundle\SearchBundle\Form\Type\AutocompleteType;
use Sil\Bundle\CRMBundle\Form\DataTransformer\CityViewTransformer;
use Sil\Bundle\CRMBundle\Form\DataTransformer\CityDataTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZipOrCityType extends AutocompleteType
{
    /**
     * @var CityDataTransformer
     */
    private $dataTransformer;

    /**
     * @var CityViewTransformer
     */
    private $viewTransformer;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $this->dataTransformer->setTargetField($options['targetField']);
        $this->viewTransformer->setTargetField($options['targetField']);

        $builder->addModelTransformer($this->dataTransformer);
        $builder->addViewTransformer($this->viewTransformer);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('allow_new_values', true);
        $resolver->setDefault('elastic_type', 'city');
        $resolver->setDefault('targetField', 'city');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sil_crm_zip_or_city';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return AutocompleteType::class;
    }

    /**
     * @param CityDataTransformer $dataTransformer
     */
    public function setDataTransformer(CityDataTransformer $dataTransformer): void
    {
        $this->dataTransformer = $dataTransformer;
    }

    /**
     * @param CityViewTransformer $viewTransformer
     */
    public function setViewTransformer(CityViewTransformer $viewTransformer): void
    {
        $this->viewTransformer = $viewTransformer;
    }
}
