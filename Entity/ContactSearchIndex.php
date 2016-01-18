<?php

namespace Librinfo\CRMBundle\Entity;

use Librinfo\DoctrineBundle\Entity\SearchIndexEntity;

class ContactSearchIndex extends SearchIndexEntity
{
    // TODO: this should go in the contact.orm.yml mapping file :
    //       find a way to override Doctrine ORM YamlDriver and ClassMetadata classes
    public static $fields = ['name', 'firstname', 'shortname', 'email', 'description', 'address', 'city', 'country'];
}
