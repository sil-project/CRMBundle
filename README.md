# SymfonySilCRMBundle


[![Build Status](https://travis-ci.org/libre-informatique/CRMBundle.svg?branch=master)](https://travis-ci.org/libre-informatique/CRMBundle)
[![Coverage Status](https://coveralls.io/repos/github/libre-informatique/CRMBundle/badge.svg?branch=master)](https://coveralls.io/github/libre-informatique/CRMBundle?branch=master)
[![License](https://img.shields.io/github/license/libre-informatique/CRMBundle.svg?style=flat-square)](./LICENCE.md)

[![Latest Stable Version](https://poser.pugx.org/libre-informatique/crm-bundle/v/stable)](https://packagist.org/packages/libre-informatique/crm-bundle)
[![Latest Unstable Version](https://poser.pugx.org/libre-informatique/crm-bundle/v/unstable)](https://packagist.org/packages/libre-informatique/crm-bundle)
[![Total Downloads](https://poser.pugx.org/libre-informatique/crm-bundle/downloads)](https://packagist.org/packages/libre-informatique/crm-bundle)





CRM Bundle for Symfony

Installation
============

Prequiresites
-------------

* having a working Symfony2 environment
* having created a working Symfony2 app (including your DB and your DB link)
* having composer installed (here in ```/usr/local/bin/composer```, having ```/usr/local/bin``` in your path)

Optional:
* having blast-project/core-bundle installed, or if not, follow the README instructions of the Core bundle 

Downloading
-----------

```
  $ composer require libre-informatique/crm-bundle dev-master
```

If it fails with the message :

```- libre-informatique/crm-bundle dev-master requires libre-informatique/core-bundle dev-master -> no matching package found.```

Try to install ```libre-informatique/core-bundle``` first :

```
$ composer require libre-informatique/core-bundle dev-master
```

The Sonata bundles
------------------

Do not forget to configure the SonataAdminBundle. e.g.:

```php
    // app/AppKernel.php
    // ...
    public function registerBundles()
    {
        $bundles = array(
            // ...
            
            // Sonata
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            
            // your personal bundles
        );
    }
    // ...
```

```
# app/config/routing.yml
admin:
    resource: '@SonataAdminBundle/Resources/config/routing/sonata_admin.xml'
    prefix: /
  
_sonata_admin:
    resource: .
    type: sonata_admin
    prefix: /
```

```
# app/config/config.yml
sonata_block:
    default_contexts: [cms]
    blocks:
        # Enable the SonataAdminBundle block
        sonata.admin.block.admin_list:
            contexts:   [admin]
        # Your other blocks
```

But please, refer to the source doc to get up-to-date :
https://sonata-project.org/bundles/admin/2-3/doc/reference/installation.html

Just notice that the ```prefix``` value is ```/``` instead of ```/admin``` as advised by the Sonata Project... By the way, it means that this access is universal, and not a specific "backend" interface. That's a specificity of a software package that intends to be focused on professional workflows.

The "libre-informatique" bundles
---------------------------------

Edit your app/AppKernel.php file and add the required bundles, here:

```php
    // app/AppKernel.php
    // ...
    public function registerBundles()
    {
        $bundles = array(
            // ...
            
            // The libre-informatique bundles
            new Blast\Bundle\CoreBundle\BlastCoreBundle(),
            new Sil\Bundle\CRMBundle\SilCRMBundle(),
            
            // your personal bundles
        );
    }
    // ...
```

Finish
------

Publish the assets ...

```
$ app/console assets:install --symlink
