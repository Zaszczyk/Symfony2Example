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
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ClinicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('patients', 'collection', array('type' => new PatientType()));

        $builder->add('patients', 'collection', array(
            'type' => new PatientType(),
            'allow_add'    => true,
            'by_reference' => false,
            'allow_delete' => true,
        ));

        $builder->setMethod('post');

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mateusz\MedicalBundle\Entity\Clinic',
        ));
    }

    public function getName()
    {
        return 'clinic';
    }
}