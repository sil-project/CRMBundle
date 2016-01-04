<?php

namespace Librinfo\CRMBundle\Admin;

use Exporter\Source\SourceIteratorInterface;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Export\Exporter as BaseExporter;
use Librinfo\CRMBundle\Entity\Circle;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class Exporter extends BaseExporter
{
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;
    
    /**
     * @var TranslatorInterface
     */
    protected $translator;
    
    /**
     * @var \Twig_Environment
     */
    protected $twig;
    
    /**
     * @var Router
     */
    protected $router;
    
    public function getResponse($format, $filename, SourceIteratorInterface $source)
    {
        if ( !in_array($format, ['group']) )
            return parent::getResponse($format, $filename, $source);
        
        switch ( $format ) {
        case 'group':
            // creates the circle
            $circle = new Circle;
            $circle->setName(
                $this->translator->trans('librinfo_crm_export_new_group')
                .' | '.
                twig_date_format_filter($this->twig, time())
            );
            $circle->setOwner($this->tokenStorage->getToken()->getUser());
            
            // sets the circle's content
            foreach ( $source->getQuery()->iterate() as $elements )
            foreach ( $elements as $element )
            {
                $rc = new \ReflectionClass($element);
                $circle->{'add'.$rc->getShortName()}($element);
            }
            
            // persisting
            $em = $source->getQuery()->getEntityManager();
            $em->persist($circle);
            $em->flush();
            
            // redirect to the list
            return new RedirectResponse($this->router->generate('admin_librinfo_crm_circle_edit', array(
                'id' => $circle->getId()
            )));
        break;
        default:
            throw new \RuntimeException('Invalid format');
        break;
        }
    }

    /**
     * setTokenStorage
     *
     * @param $tokenStorage     TokenStorageInterface
     */
    public function setTokenStorage(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
        return $this;
    }
    
    /**
     * setTranslator
     *
     * @param $translator     TokenStorageInterface
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
        return $this;
    }
    
    /**
     * setTwig
     *
     * @param $twig     \Twig_Environment
     */
    public function setTwig(\Twig_Environment $twig)
    {
        $this->twig = $twig;
        return $this;
    }
    
    /**
     * setRouter
     *
     * @param $router     \Twig_Environment
     */
    public function setRouter(Router $router)
    {
        $this->router = $router;
        return $this;
    }
}
