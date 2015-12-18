<?php

namespace Librinfo\CRMBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

class CircleAdminController extends CRUDController
{
   /**
     * Edit action.
     *
     * @param int|string|null $id
     * @param Request         $request
     *
     * @return Response|RedirectResponse
     *
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedException If access is not granted
     */
    public function editAction($id = null, Request $request = null)
    {
        $request = $this->resolveRequest($request);
        
        // the key used to lookup the template
        $templateKey = 'edit';

        $id     = $request->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('unable to find the object with id : %s', $id));
        }

        $this->admin->checkAccess('edit', $object);

        $preResponse = $this->preEdit($request, $object);
        if ($preResponse !== null) {
            return $preResponse;
        }
        
        // current Contact objects in the database (for deletion, if needed)
        $originalContacts = new ArrayCollection();
        foreach ($object->getContacts() as $contact) {
            $originalContacts->add($contact);
        }
        
        // current Organisme objects in the database (for deletion, if needed)
        $originalOrganisms = new ArrayCollection();
        foreach ($object->getOrganisms() as $organism) {
            $originalOrganisms->add($organism);
        }

        $this->admin->setSubject($object);

        /** @var $form Form */
        $form = $this->admin->getForm();
        $form->setData($object);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode($request) || $this->isPreviewApproved($request))) {
                try {
                    // remove Contacts from Circle
                    foreach ($originalContacts as $contact) {
                        if (false === $object->getContacts()->contains($contact)) {
                            // remove the Contact / Circle link
                            $contact->removeCircle($object);

                            // TODO: test $this->admin->update($contact);
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($contact);
                        }
                    }                    
                    // remove Organisms from Circle
                    foreach ($originalOrganisms as $organism) {
                        if (false === $object->getOrganisms()->contains($organism)) {
                            // remove the Organism / Circle link
                            $organism->removeCircle($object);

                            // TODO: test $this->admin->update($organism);
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($organism);
                        }
                    }                    
                    
                    $object = $this->admin->update($object);

                    if ($this->isXmlHttpRequest($request)) {
                        return $this->renderJson(array(
                            'result'     => 'ok',
                            'objectId'   => $this->admin->getNormalizedIdentifier($object),
                            'objectName' => $this->escapeHtml($this->admin->toString($object)),
                        ), 200, array(), $request);
                    }

                    $this->addFlash(
                        'sonata_flash_success',
                        $this->admin->trans(
                            'flash_edit_success',
                            array('%name%' => $this->escapeHtml($this->admin->toString($object))),
                            'SonataAdminBundle'
                        )
                    );

                    // redirect to edit mode
                    return $this->redirectTo($object, $request);
                } catch (ModelManagerException $e) {
                    $this->handleModelManagerException($e);

                    $isFormValid = false;
                } catch (LockException $e) {
                    $this->addFlash('sonata_flash_error', $this->admin->trans('flash_lock_error', array(
                        '%name%'       => $this->escapeHtml($this->admin->toString($object)),
                        '%link_start%' => '<a href="'.$this->admin->generateObjectUrl('edit', $object).'">',
                        '%link_end%'   => '</a>',
                    ), 'SonataAdminBundle'));
                }
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest($request)) {
                    $this->addFlash(
                        'sonata_flash_error',
                        $this->admin->trans(
                            'flash_edit_error',
                            array('%name%' => $this->escapeHtml($this->admin->toString($object))),
                            'SonataAdminBundle'
                        )
                    );
                }
            } elseif ($this->isPreviewRequested($request)) {
                // enable the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'edit',
            'form'   => $view,
            'object' => $object,
        ), null, $request);
    }
    
    /**
     * To keep backwards compatibility with older Sonata Admin code.
     *
     * @internal
     */
    private function resolveRequest(Request $request = null)
    {
        if (null === $request) {
            return $this->getRequest();
        }

        return $request;
    }    
}
