<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 2015-05-08
 * Time: 18:54
 */

namespace Mateusz\MedicalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * @ORM\Entity(repositoryClass="PatientRepository")
 * @ORM\Table(name="patients")
 */
class Patient {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=11, options={"fixed" = true})
     */
    protected $pesel;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateBirth;

    /**
     * @ManyToMany(targetEntity="Clinic", inversedBy="patient")
     * @JoinTable(name="patients_clinics")
     **/
    private $clinics;

    public function __construct() {
        $this->$clinics = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function getFirstName(){
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName(){
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName){
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getPesel(){
        return $this->pesel;
    }

    /**
     * @param mixed $pesel
     */
    public function setPesel($pesel){
        $this->pesel = $pesel;
    }

    /**
     * @return mixed
     */
    public function getDateBirth(){
        return $this->dateBirth;
    }

    /**
     * @param mixed $dateBirth
     */
    public function setDateBirth($dateBirth){
        $this->dateBirth = $dateBirth;
    }

    /**
     * @return mixed
     */
    public function getClinics(){
        return $this->clinics;
    }

    /**
     * @param mixed $clinics
     */
    public function setClinics($clinics){
        $this->clinics = $clinics;
    }
}