<?php

/*
 * This file is part of the Sil Project.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Admin\Writer;

use Blast\Bundle\CoreBundle\Admin\BaseWriter;
use JeroenDesloovere\VCard\VCard;

class VCardWriter extends BaseWriter
{
    protected $autoExcluded = [
        'name',
        'address',
        'email',
    ];

    protected $matches = [
        'note' => 'description',
    ];

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        parent::configure($filename);
    }

    /**
     * {@inheritdoc}
     */
    public function write(array $data)
    {
        $vcard = new VCard();

        $type = isset($data['professional']) && $data['professional']
            ? 'WORK'
            : 'HOME'
        ;

        $rc = new \ReflectionClass($vcard);
        foreach ($rc->getMethods() as $method) {
            if (substr($method->name, 0, 3) == 'add') {
                $prop = strtolower(substr($method->name, 3));
                if (in_array($prop, $this->autoExcluded)) {
                    continue;
                }

                if (isset($data[$prop])) {
                    $vcard->{$method->name}($data[$prop]);
                } elseif (isset($this->matches[$prop]) && isset($data[$this->matches[$prop]])) {
                    $vcard->{$method->name}($data[$this->matches[$prop]]);
                }
            }
        }

        // the name
        foreach (['name', 'firstname', 'title', 'additional', 'prefix', 'suffix'] as $field) {
            if (!isset($data[$field])) {
                $data[$field] = '';
            }
        }
        $vcard->addName($data['name'], $data['firstname'], '', $data['title'], '');

        // the address
        $go = false;
        foreach (['address', 'city', 'zip', 'country'] as $field) {
            if (!isset($data[$field])) {
                $data[$field] = '';
            } else {
                $go = true;
            }
        }
        if ($go) {
            $vcard->addAddress('', '', $data['address'], $data['city'], '', $data['zip'], $data['country'], sprintf('%s;POSTAL', $type));
        }

        // phone numbers
        if (isset($data['phones']) && is_array($data['phones'])) {
            foreach ($data['phones'] as $phone) {
                $vcard->addPhoneNumber($phone, sprintf('%s;VOICE', $type));
            }
        }

        // the emails
        if (isset($data['email'])) {
            $vcard->addEmail($data['email'], $type);
        }

        // the positions
        $i = 0;
        if (isset($data['positions']) && is_array($data['positions'])) {
            foreach ($data['positions'] as $position) {
                if ($i == 0) {
                    $vcard->addJobTitle($position['label']);
                }
                $vcard->addPhoneNumber($position['phone'], 'WORK');
                $vcard->addEmail($position['email'], 'WORK');

                $go = false;
                foreach (['organism.address', 'organism.city', 'organism.zip', 'organism.country'] as $field) {
                    if (!isset($position[$field])) {
                        $position[$field] = '';
                    } else {
                        $go = true;
                    }
                }
                if ($go) {
                    $vcard->addAddress('', '', $position['organism.address'], $position['organism.city'], '', $position['organism.zip'], $position['organism.country'], sprintf('%s;POSTAL', 'WORK'));
                }

                ++$i;
            }
        }

        $this->_write($vcard->getOutput());

        return $this;
    }

    /**
     * getFilename().
     *
     * @param $filename string
     *
     * @return string
     */
    public function getFilename($filename = false)
    {
        $vcard = new VCard();

        return sprintf('%s.%s', preg_replace('/\.vcard/', '', $filename ? $filename : $this->filename), $vcard->getFileExtension());
    }
}
