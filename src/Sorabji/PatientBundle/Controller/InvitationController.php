<?php

namespace Sorabji\PatientBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sorabji\PatientBundle\Entity\Invitation;
use Sorabji\PatientBundle\Form\InvitationType;

/**
 * Invitation controller.
 *
 * @Route("/invitation")
 */
class InvitationController extends Controller
{
    /**
     * Lists all Invitation entities.
     *
     * @Route("/", name="invitation")
     * @Template()
     *
     * @Secure(roles="ROLE_ADMIN")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SorabjiPatientBundle:Invitation')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Invitation entity.
     *
     * @Route("/{id}/show", name="invitation_show")
     * @Template()
     *
     * @Secure(roles="ROLE_ADMIN")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SorabjiPatientBundle:Invitation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Invitation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Invitation entity.
     *
     * @Route("/new", name="invitation_new")
     * @Template()
     *
     * @Secure(roles="ROLE_ADMIN")
     */
    public function newAction()
    {
        $entity = new Invitation();
        $form   = $this->createForm(new InvitationType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Invitation entity.
     *
     * @Route("/create", name="invitation_create")
     * @Method("POST")
     * @Template("SorabjiPatientBundle:Invitation:new.html.twig")
     *
     * @Secure(roles="ROLE_ADMIN")
     */
    public function createAction(Request $request)
    {
        $entity  = new Invitation();
        $form = $this->createForm(new InvitationType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('invitation_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Invitation entity.
     *
     * @Route("/{id}/edit", name="invitation_edit")
     * @Template()
     *
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SorabjiPatientBundle:Invitation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Invitation entity.');
        }

        $editForm = $this->createForm(new InvitationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Invitation entity.
     *
     * @Route("/{id}/update", name="invitation_update")
     * @Method("POST")
     * @Template("SorabjiPatientBundle:Invitation:edit.html.twig")
     *
     * @Secure(roles="ROLE_ADMIN")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SorabjiPatientBundle:Invitation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Invitation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new InvitationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('invitation_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Invitation entity.
     *
     * @Route("/{id}/delete", name="invitation_delete")
     * @Method("POST")
     *
     * @Secure(roles="ROLE_ADMIN")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SorabjiPatientBundle:Invitation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Invitation entity.');
            }
            $entity->getUser()->setInvitation(null);
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('invitation'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}