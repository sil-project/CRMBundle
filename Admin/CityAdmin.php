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
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CityAdmin extends CoreAdmin
{
    /**
     * @var string
     */
    protected $translationLabelPrefix = 'sil.crm.city';

    protected $baseRouteName = 'admin_crm_city';
    protected $baseRoutePattern = 'crm/city';

    protected $datagridValues = array(
        '_page'       => 1,
        '_sort_order' => 'ASC',
        '_sort_by'    => 'zip',
    );

    protected function configureRoutes(RouteCollection $collection)
    {
        // xxxxxxxAction in CRUD controller
        $collection->add('getAddressAutocompleteItems');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('zip')
            ->add('city')
            ->add('country_code')
            ->add('insee_code')
            // ->add('lat')
            // ->add('lng')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('zip')
            ->add('city')
            ->add('country_code')
            ->add('insee_code')
            // ->add('lat')
            // ->add('lng')
        ;
        parent::configureListFields($listMapper);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('zip')
            ->add('city')
            ->add('country_code')
            ->add('insee_code')
            ->add('lat')
            ->add('lng')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('zip')
            ->add('city')
            ->add('country_code')
            ->add('insee_code')
            ->add('lat')
            ->add('lng')
            ->add('map', null, [
                'mapped'   => false,
                'template' => 'SilCRMBundle:CRUD:show_field_map.html.twig',
                'label'    => false,
            ])
        ;
    }
}
