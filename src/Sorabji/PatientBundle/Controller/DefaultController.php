<?php

namespace Sorabji\PatientBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sorabji\PatientBundle\Document\Patient;
use Sorabji\PatientBundle\Form\Type\PatientType;
use Sorabji\PatientBundle\Form\Type\SearchPatientType;

class DefaultController extends Controller {

  /**
   * @Route("/", name="patient")
   * @Route("/portal", name="portal")
   * @Template()
   * @Secure(roles="ROLE_USER")
   */
  public function indexAction(){
    $dm = $this->get('doctrine_mongodb')->getManager();
    $patients = $dm->getRepository("SorabjiPatientBundle:Patient")->findAll();
    return array('entities' => $patients);
  }

  /**
   * @Route("/search", name="patient_search")
   * @Template()
   * @Secure(roles="ROLE_USER")
   */
  public function searchAction(){
    $form   = $this->createForm(new SearchPatientType());
    return array('form' => $form->createView());
  }

  /**
   * @Route("/results", name="patient_results")
   * @Secure(roles="ROLE_USER")
   */
  public function resultsAction(Request $request){
    $response = new JsonResponse();
    if("POST" != $request->getMethod()){
      return $response->setData(array("msg" => "POST allein bitte", "success" => false));
    }

    $form = $this->createForm(new SearchPatientType());
    $form->bind($request);
    $data = $form->getData();

    $dm = $this->get('doctrine_mongodb')->getManager();
    $patient_repo = $dm->getRepository("SorabjiPatientBundle:Patient");
    $data = $patient_repo->getResults($data);
    $array_data = $data->toArray();
    $array_data = array_map(function($v){ return $v->toArray(); }, $array_data);
    return $response->setData(array(
      "msg" => "success",
      "success" => true,
      "data" => $array_data,
      "rows" => count($array_data),
    ));
  }

  /**
   * Finds and displays a Patient
   *
   * @Route("/{id}/show", name="patient_show")
   * @Template()
   *
   * @Secure(roles="ROLE_ADMIN")
   */
  public function showAction($id)
  {
    $dm = $this->get('doctrine_mongodb')->getManager();

    $entity = $dm->getRepository('SorabjiPatientBundle:Patient')->find($id);
    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Patient.');
    }

    $deleteForm = $this->createDeleteForm($id);

    return array(
      'entity'      => $entity,
      'delete_form' => $deleteForm->createView(),
    );
  }

  /**
   * Displays a form to create a new Patient.
   *
   * @Route("/new", name="patient_new")
   * @Template()
   *
   * @Secure(roles="ROLE_ADMIN")
   */
  public function newAction()
  {
    $entity = new Patient();
    $form   = $this->createForm(new PatientType(), $entity);

    return array(
      'entity' => $entity,
      'form'   => $form->createView(),
    );
  }

  /**
   * Creates a new Patient
   *
   * @Route("/create", name="patient_create")
   * @Method("POST")
   * @Template("SorabjiPatientBundle:Default:new.html.twig")
   *
   * @Secure(roles="ROLE_ADMIN")
   */
  public function createAction(Request $request)
  {
    $entity  = new Patient();
    $form = $this->createForm(new PatientType(), $entity);
    $form->bind($request);

    if ($form->isValid()) {
      $dm = $this->get('doctrine_mongodb')->getManager();
      $dm->persist($entity);
      $dm->flush();

      return $this->redirect($this->generateUrl('patient_show', array('id' => $entity->getId())));
    }

    return array(
      'entity' => $entity,
      'form'   => $form->createView(),
    );
  }

  /**
   * Displays a form to edit an existing Patient.
   *
   * @Route("/{id}/edit", name="patient_edit")
   * @Template()
   *
   * @Secure(roles="ROLE_ADMIN")
   */
  public function editAction($id)
  {
    $dm = $this->get('doctrine_mongodb')->getManager();

    $entity = $dm->getRepository('SorabjiPatientBundle:Patient')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Patient.');
    }

    $editForm = $this->createForm(new PatientType(), $entity);
    $deleteForm = $this->createDeleteForm($id);

    return array(
      'entity'      => $entity,
      'edit_form'   => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    );
  }

  /**
   * Edits an existing Patient.
   *
   * @Route("/{id}/update", name="patient_update")
   * @Method("POST")
   * @Template("SorabjiPatientBundle:Default:edit.html.twig")
   *
   * @Secure(roles="ROLE_ADMIN")
   */
  public function updateAction(Request $request, $id)
  {
    $dm = $this->get('doctrine_mongodb')->getManager();

    $entity = $dm->getRepository('SorabjiPatientBundle:Patient')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Patient.');
    }

    $deleteForm = $this->createDeleteForm($id);
    $editForm = $this->createForm(new PatientType(), $entity);
    $editForm->bind($request);

    if ($editForm->isValid()) {
      $dm->persist($entity);
      $dm->flush();
      return $this->redirect($this->generateUrl('patient_edit', array('id' => $id)));
    }

    return array(
      'entity'      => $entity,
      'edit_form'   => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    );
  }

  /**
   * Deletes a Patient.
   *
   * @Route("/{id}/delete", name="patient_delete")
   * @Method("POST")
   *
   * @Secure(roles="ROLE_ADMIN")
   */
  public function deleteAction(Request $request, $id)
  {
    $form = $this->createDeleteForm($id);
    $form->bind($request);

    if ($form->isValid()) {
      $dm = $this->get('doctrine_mongodb')->getManager();
      $entity = $dm->getRepository('SorabjiPatientBundle:Patient')->find($id);

      if (!$entity) {
        throw $this->createNotFoundException('Unable to find Patient.');
      }
      $dm->remove($entity);
      $dm->flush();
    }

    return $this->redirect($this->generateUrl('patient'));
  }

  private function createDeleteForm($id)
  {
    return $this->createFormBuilder(array('id' => $id))
      ->add('id', 'hidden')
      ->getForm()
      ;
  }
}
