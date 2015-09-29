# SymfonyLibrinfoCRMBundle
CRM Bundle for Symfony

Installation
============

Prequiresites
-------------

* having a working Symfony2 environment
* having created a working Symfony2 app (including your DB and your DB link)
* having composer installed (here in /usr/local/bin/composer, with /usr/local/bin in the path)

Optional:
* having libre-informatique/core-bundle installed, or if not, follow the README instructions of the Core bundle 

Downloading
-----------

```
  $ composer require libre-informatique/crm-bundle dev-master
```

The "libre-informatique" bundles
---------------------------------

Edit your app/AppKernel.php file and add the required bundles, here:
* Librinfo\CoreBundle\CoreBundle(),
* Librinfo\CoreBundle\CRMBundle(),

```php
    // app/AppKernel.php
    // ...
    public function registerBundles()
    {
        $bundles = array(
            // ...
            
            // The libre-informatique bundles
            new Librinfo\CoreBundle\CoreBundle(),
            new Librinfo\CoreBundle\CRMBundle(),
            
            // your personal bundles
        );
    }
    // ...
```

The Sonata bundles
------------------

Do not forget to configure the SonataAdminBundle. e.g.:

```
# app/config/routing.yml
admin:
    resource: '@SonataAdminBundle/Resources/config/routing/sonata_admin.xml'
    prefix: /admin
  
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
