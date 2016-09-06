<?php

namespace Librinfo\CRMBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use Librinfo\DoctrineBundle\EventListener\Traits\ClassChecker;
use Monolog\Logger;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

class EmailBundleListener implements LoggerAwareInterface, EventSubscriber
{
    use ClassChecker;

    /**
     * @var array
     */
    private $bundles;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            'loadClassMetadata',
            //'prePersist',
            //'preUpdate',
        ];
    }

    /**
     * define mapping with Organism, Postion and Contact at runtime if LibrinfoCRMBundle exists
     *
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        if ( !array_key_exists('LibrinfoEmailBundle', $this->bundles) )
            return;

        /** @var ClassMetadata $metadata */
        $metadata = $eventArgs->getClassMetadata();
        $reflectionClass = $metadata->getReflectionClass();
        if (!$reflectionClass || !$this->hasTrait($reflectionClass, 'Librinfo\DoctrineBundle\Entity\Traits\Emailable'))
            return;

        // Check if parents already have the Emailable trait
        foreach ($metadata->parentClasses as $parent)
            if ($this->classAnalyzer->hasTrait($parent, 'Librinfo\DoctrineBundle\Entity\Traits\Emailable'))
                return;

        $this->logger->debug("[EmailBundleListener] Entering EmailBundleListener for « loadClassMetadata » event");

        // mapping with Emails (many-to-many inverse side)
        $metadata->mapManyToMany([
            'targetEntity' => 'Librinfo\EmailBundle\Entity\Email',
            'fieldName'    => 'emailMessages',
            'mappedBy'     => strtolower($reflectionClass->getShortName()) . 's'  // ex. "organisms"
        ]);

        $this->logger->debug("[EmailBundleListener] Added Email mapping metadata to Entity", ['class' => $metadata->getName()]);
    }

    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     * @return null
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function setBundles($kernelBundles)
    {
        $this->bundles = $kernelBundles;
    }

}
