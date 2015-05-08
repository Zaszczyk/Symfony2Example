<?php

namespace Mateusz\MedicalBundle\Controller;

use Mateusz\MedicalBundle\Form\Type\PatientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mateusz\MedicalBundle\Entity\Patient;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PatientController extends Controller
{
    /**
     * @Route("/patient/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name . ' pacjent');
    }

    /**
     * @Route("/patient/new")
     */
    public function newAction(Request $request)
    {
        $patient = new Patient();
        $form = $this->createForm(new PatientType(), $patient);

        $formWithRequest = clone $form;

        $formWithRequest->handleRequest($request);


        if ($formWithRequest->isValid()) {
            $patientForm = $formWithRequest->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($patientForm);
            $em->flush();

            $session = $this->getRequest()->getSession();
            $session->getFlashBag()->add('message', 'Pacjent został dodany.');
        }


        return $this->render('MateuszMedicalBundle:Patient:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}