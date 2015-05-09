<?php

namespace Mateusz\MedicalBundle\Controller;

use Mateusz\MedicalBundle\Form\Type\ClinicType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mateusz\MedicalBundle\Entity\Clinic;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ClinicController extends Controller
{

    /**
     * @Route("/clinic/new")
     */
    public function newAction(Request $request)
    {
        $clinic = new Clinic();
        $form = $this->createForm(new ClinicType(), $clinic);

        $formWithRequest = clone $form;

        $formWithRequest->handleRequest($request);


        if ($formWithRequest->isValid()) {
            $clinicForm = $formWithRequest->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($clinicForm);
            $em->flush();

            $session = $this->getRequest()->getSession();
            $session->getFlashBag()->add('success', 'Klinika została dodana.');
        }


        return $this->render('MateuszMedicalBundle:Clinic:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}