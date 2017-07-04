<?php

/*
 * This file is part of the Blast Project package.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Librinfo\CRMBundle\Entity;

use Blast\BaseEntitiesBundle\Entity\SearchIndexEntity;

class OrganismSearchIndex extends SearchIndexEntity
{
    // TODO: this should go in the organism.orm.yml mapping file :
    //       find a way to override Doctrine ORM YamlDriver and ClassMetadata classes
    public static $fields = ['name', 'firstname', 'lastname', 'description', 'email', 'url'];
}
