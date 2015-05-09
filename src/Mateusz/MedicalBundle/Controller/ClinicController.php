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

    /**
     * @Route("/clinic/edit/{id}")
     */
    public function editAction($id, Request $request)
    {
        //pobieram encję Clinic o danym ID
        $clinic = $this->getDoctrine()
            ->getRepository('MateuszMedicalBundle:Clinic')
            ->find($id);

        if($clinic == null){
            $this->addFlash('danger', 'Taka klinika nie istnieje, ale możesz dodać nową.');
            $this->redirect('clinic/new/');
        }

        //tworzę dla tej encji formularz
        $form = $this->createForm(new ClinicType(), $clinic);

        $formWithRequest = clone $form;

        $formWithRequest->handleRequest($request);

        //sprawdzam czy jest zapytanie z formularza do obrobienia
        if ($formWithRequest->isValid()) {
            $clinicForm = $formWithRequest->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($clinicForm);
            $em->flush();

            $this->addFlash('success', 'Klinika została zapisana.');
        }

        //i znowu muszę pobrać encję Clinic, ponieważ została zaktualizowna
        $clinic = $this->getDoctrine()
            ->getRepository('MateuszMedicalBundle:Clinic')
            ->find($id);

        //i znowu muszę stworzyć formularz dla tej encji, bardzo nie podoba mi się taki sposób. Szukałem 10 minut jak to obejść, nie znalazłem nic fajnego...
        $form = $this->createForm(new ClinicType(), $clinic);

        return $this->render('MateuszMedicalBundle:Clinic:edit.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}