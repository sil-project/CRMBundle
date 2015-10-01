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
            new Librinfo\CRMBundle\CRMBundle(),
            
            // your personal bundles
        );
    }
    // ...
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

Finish
------

Publish the assets ...

```
$ app/console assets:install
```

Usages
======

Configuring your SonataAdminBundle interfaces with YAML properties
------------------------------------------------------------------

This feature is provided by Librinfo\CoreBundle to ease the deployment of new bundles & entities. It works quite closely to the  [Sonata\AdminBundle\MapperBaseMapper](https://github.com/sonata-project/SonataAdminBundle/blob/master/Mapper/BaseMapper.php) & [Sonata\AdminBundle\MapperBaseGroupedMapper](https://github.com/sonata-project/SonataAdminBundle/blob/master/Mapper/BaseGroupedMapper.php) (and their children like [Sonata\AdminBundle\Form\FormMapper](https://github.com/sonata-project/SonataAdminBundle/blob/master/Form/FormMapper.php)) add(), with()/tab() & remove() methods.

So it is structured as :

```
        AcmeBundle\Admin\DemoAdmin:               # The Admin class extension
            Sonata\AdminBundle\Form\FormMapper:   # The class of objects that needs to be configured (here the edit/create form)
                remove: [name, id]                # The fields that need to be removed from inheritance (array)
                add:                              # What we want to display (associative array)
                    text:                         # The name of a field that needs to be directly injected (without any tab)
                        type: textarea            # The type of field to display
                        required: false           # Other options refering to the BaseMapper super-class used
                    gfx_tab:                      # A first tab
                        _options:                 # ... with its options (cf. BaseGroupedMapper::with() options)
                            description: tab
                        gfx_group:                # A first group inside the "tab"
                            _options:             # ... with its options (cf. BaseGroupedMapper::with() options)
                                description: with
                            title: ~              # Adding a field, with no option
                            description:
                                type: textarea
                                label: Descriiiiiiption
                                _options:         # Extra options ("fieldDescriptionOptions" in the BaseMapper::add super-class)
                                    translation_domain: fr
                        gfx_group2:
                            field2: ~
            Sonata\AdminBundle\Show\ShowMapper:   # The class of objects that needs to be configured (here the "show" view)
                _copy: Sonata\AdminBundle\Form\FormMapper # indicates to take the configuration of an other class of the current Admin class extension (including its parents configuration)
```
