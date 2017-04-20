<?php

namespace Librinfo\CRMBundle\Entity;

use Blast\BaseEntitiesBundle\Entity\SearchIndexEntity;

class AddressSearchIndex extends SearchIndexEntity
{
    public static $fields = ['lastName', 'firstName', 'postCode', 'street', 'city', 'countryCode', 'provinceCode', 'provinceName'];
}
