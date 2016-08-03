<?php

namespace Librinfo\CRMBundle\Admin;

use Librinfo\CoreBundle\Admin\Traits\HandlesRelationsAdmin;

class ContactAdminConcrete extends ContactAdmin
{
    use HandlesRelationsAdmin;

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('LibrinfoCRMBundle:Form:form_admin_fields.html.twig')
        );

    }
}

