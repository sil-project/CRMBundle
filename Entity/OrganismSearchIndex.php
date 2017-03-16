<?php

namespace Librinfo\CRMBundle\Entity;

use Blast\BaseEntitiesBundle\Entity\SearchIndexEntity;

class OrganismSearchIndex extends SearchIndexEntity
{
    // TODO: this should go in the organism.orm.yml mapping file :
    //       find a way to override Doctrine ORM YamlDriver and ClassMetadata classes
    public static $fields = ['name', 'firstname', 'lastname', 'description', 'email', 'url'];
}
