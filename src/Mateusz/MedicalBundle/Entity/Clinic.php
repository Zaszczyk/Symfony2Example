<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 2015-05-08
 * Time: 18:50
 */

namespace Mateusz\MedicalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * @ORM\Entity
 * @ORM\Table(name="clinics")
 */
class Clinic {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $name;


    /**
     * @ORM\ManyToMany(targetEntity="Patient", inversedBy="patients", cascade={"persist"})
     * @ORM\JoinTable(name="patients_clinics")
     **/
    private $patients;

    public function __construct() {
        $this->patients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPatients(){
        return $this->patients;
    }

    /**
     * @param mixed $patients
     */
    public function setPatients($patients){
        $this->patients = $patients;
    }

    public function addPatient(Patient $patient)
    {
        $patient->addClinic($this);

        $this->patients->add($patient);
    }

    public function removePatient(Patient $patient)
    {
        $this->patients->removeElement($patient);
    }

}