<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 2015-05-08
 * Time: 21:15
 */

namespace Mateusz\MedicalBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Mateusz\MedicalBundle\Entity\Patient;

class PatientNamesSubscriber implements EventSubscriber{
    public function getSubscribedEvents(){
        return array('prePersist', 'preUpdate');
    }

    public function preUpdate(LifecycleEventArgs $args){
        $this->index($args);
    }

    public function prePersist(LifecycleEventArgs $args){
        $this->index($args);
    }

    public function index(LifecycleEventArgs $args){
        $entity = $args->getObject();

        if($entity instanceof Patient){
            $entity->setFirstName(ucfirst($entity->getFirstName()));
            $entity->setLastName(ucfirst($entity->getLastName()));
        }
    }
}