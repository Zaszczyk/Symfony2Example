<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 2015-05-08
 * Time: 19:34
 */

namespace Mateusz\MedicalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PatientType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', 'text');
        $builder->add('lastName', 'text');
        $builder->add('pesel', 'text');
        $builder->add('dateBirth', 'date');
        $builder->setMethod('post');
    }

    public function getName()
    {
        return 'patient';
    }
}