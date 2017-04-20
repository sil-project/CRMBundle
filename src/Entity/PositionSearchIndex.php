<?php

namespace Librinfo\CRMBundle\Entity;

use Blast\BaseEntitiesBundle\Entity\SearchIndexEntity;

class PositionSearchIndex extends SearchIndexEntity
{
    // TODO: this should go in the organism.orm.yml mapping file :
    //       find a way to override Doctrine ORM YamlDriver and ClassMetadata classes
    public static $fields = ['label', 'description', 'email', 'department'];
}
