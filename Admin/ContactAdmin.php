<?php

namespace Librinfo\CRMBundle\Admin;

use Blast\CoreBundle\Admin\CoreAdmin;
use Blast\CoreBundle\Admin\Traits\HandlesRelationsAdmin;

class ContactAdmin extends CoreAdmin
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
