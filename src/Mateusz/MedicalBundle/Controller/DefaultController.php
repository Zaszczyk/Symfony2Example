<?php

namespace Mateusz\MedicalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mateusz\MedicalBundle\Entity\Patient;
use Symfony\Component\HttpFoundation\Request;
use Mateusz\MedicalBundle\Form\Type\PatientType;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name . ' default');
    }

}
