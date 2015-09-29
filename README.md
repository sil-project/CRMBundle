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

  $ composer require libre-informatique/crm-bundle dev-master

The "libre-informatique" bundles
--------------------------------

Edit your app/AppKernel.php file and add your "libre-informatique" bundle, for instance the "libre-informatique/core-bundle" :

    // app/AppKernel.php
    // ...
    public function registerBundles()
    {
        $bundles = array(
            // ...
            
            // The libre-informatique bundles
            new Librinfo\CoreBundle\CoreBundle(),
            new Librinfo\CoreBundle\CRMBundle(),
            
            // Adding the Sonata EasyExtendsBundle
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            
            // your personal bundles
        );
    }
