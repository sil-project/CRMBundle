<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Admin;

use Blast\Bundle\CoreBundle\Admin\CoreAdmin;
use Blast\Bundle\UtilsBundle\Form\Type\CustomChoiceType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class OrganismEmbeddedAdmin extends CoreAdmin
{
    /**
     * @var string
     */
    protected $translationLabelPrefix = 'sil.crm.organism';

    // protected $baseRouteName = 'admin_vendor_bundlename_adminclassname';
    // protected $baseRoutePattern = 'unique-route-pattern';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', CustomChoiceType::class, [
                'blast_choices' => ['Mr', 'Mrs'],
                'choices_field' => 'contact.title',
                'required'      => false,
            ])
            ->add('firstname')
            ->add('name', 'text', ['required' => false])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
    }
}
