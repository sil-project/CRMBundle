<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Admin\Traits;

use Sonata\AdminBundle\Form\FormMapper;

trait ZipCityFormEventsHandler
{
    public function handleZipCityFormType(FormMapper $mapper, $fieldsConfig)
    {
        foreach ($fieldsConfig as $formField => $cityField) {
            $transformer = $this->getConfigurationPool()->getContainer()->get('sil_crm.form.data_transformer.city_data_transformer');
            $transformer->setTargetField($cityField);

            $viewTransformer = $this->getConfigurationPool()->getContainer()->get('sil_crm.form.data_transformer.city_view_transformer');
            $viewTransformer->setTargetField($cityField);

            $mapper->get($formField)->addModelTransformer($transformer);
            $mapper->get($formField)->addViewTransformer($viewTransformer);
        }
    }
}
