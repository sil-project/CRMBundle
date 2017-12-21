<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZipCityType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $compound = function (Options $options) {
            return $options['multiple'];
        };

        $resolver->setDefaults(array(
            'attr'          => array(),
            'compound'      => $compound,
            'model_manager' => null,
            'class'         => null,
            'admin_code'    => null,
            'callback'      => null,
            'width'         => '',
            'context'       => '',

            'placeholder'          => '',
            'minimum_input_length' => 2, //minimum 2 chars should be typed to load ajax data
            'items_per_page'       => 10, //number of items per page
            'quiet_millis'         => 100,
            'cache'                => false,
            'multiple'             => false,

            'to_string_callback' => null,

            // ajax parameters
            'url'                           => '',
            'route'                         => array('name' => 'blast_search_term_ajax', 'parameters' => []),
            'req_params'                    => ['index' => 'global', 'type' => 'city'],
            'req_param_name_search'         => 'q',
            'req_param_name_page_number'    => 'page',
            'req_param_name_items_per_page' => '_per_page',

            // CSS classes
            'container_css_class'     => '',
            'dropdown_css_class'      => '',
            'dropdown_item_css_class' => '',

            'dropdown_auto_width' => false,
            'zip_field'           => 'zip',
            'city_field'          => 'city',
            'linked'              => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['admin_code'] = $options['admin_code'];

        $view->vars['placeholder'] = $options['placeholder'];
        $view->vars['minimum_input_length'] = $options['minimum_input_length'];
        $view->vars['items_per_page'] = $options['items_per_page'];
        $view->vars['width'] = $options['width'];
        $view->vars['zip_field'] = $options['zip_field'];
        $view->vars['city_field'] = $options['city_field'];
        $view->vars['linked'] = $options['linked'];

        // ajax parameters
        $view->vars['url'] = $options['url'];
        $view->vars['route'] = $options['route'];
        $view->vars['req_params'] = $options['req_params'];
        $view->vars['req_param_name_search'] = $options['req_param_name_search'];
        $view->vars['req_param_name_page_number'] = $options['req_param_name_page_number'];
        $view->vars['req_param_name_items_per_page'] = $options['req_param_name_items_per_page'];
        $view->vars['quiet_millis'] = $options['quiet_millis'];
        $view->vars['cache'] = $options['cache'];

        // CSS classes
        $view->vars['container_css_class'] = $options['container_css_class'];
        $view->vars['dropdown_css_class'] = $options['dropdown_css_class'];
        $view->vars['dropdown_item_css_class'] = $options['dropdown_item_css_class'];
        $view->vars['dropdown_auto_width'] = $options['dropdown_auto_width'];

        $view->vars['context'] = $options['context'];
    }

    public function getParent()
    {
        return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sil_zip_city';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
