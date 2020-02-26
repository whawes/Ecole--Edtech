<?php

//src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\MessageBundle\Model\ParticipantInterface;
use Doctrine\ORM\Mapping as ORM;
use EdtechBundle\Entity\course;

/**
  *@ORM\Entity
  *@ORM\Table(name = "fos_user")
 */
class User extends BaseUser implements ParticipantInterface
{
	    /**
	     * @ORM\Id
	     * @ORM\Column(type="integer")
	   ss  * @ORM\GeneratedValue(strategy="AUTO")
	     */
	    protected $id;

    /**
     * @ORM\Column(type="string",length=225)
     *
     */
    protected $nom;
    /**
     * @ORM\Column(type="integer")
     *
     */
    protected $TypeIntelligence;
  /*  /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="EdtechBundle\Entity\course", mappedBy="niveau")
     *
     */
 /*   protected $niveau;*/

    /**
     * @return mixed
     */

    public function getTypeIntelligence()
    {
        return $this->TypeIntelligence;
    }

    /**
     * @param mixed $TypeIntelligence
     */
    public function setTypeIntelligence($TypeIntelligence)
    {
        $this->TypeIntelligence = $TypeIntelligence;
    }

    /**
     * @ORM\OneToMany(targetEntity="EdtechBundle\Entity\course" ,mappedBy="user")
     */
    protected $courses;

  /*  /**
     * @return mixed
     */
   /* public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * @param mixed $niveau
     */
 /*   public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    }*/

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @ORM\Column(type="string",length=225)
     *
     */
    protected $prenom;

	    public function __construct()
	    {
	        parent::__construct();
	        $this-> courses = new ArrayCollection();

	    }
      
    /**
     * Add course
     *
     * @param \EdtechBundle\Entity\course $course
     *
     * @return User
     */
    public function addCourse(\EdtechBundle\Entity\course $course)
    {
        $this->courses[] = $course;

        return $this;
    }

    /**
     * Remove course
     *
     * @param \EdtechBundle\Entity\course $course
     */
    public function removeCourse(\EdtechBundle\Entity\course $course)
    {
        $this->courses->removeElement($course);
    }

    /**
     * Get courses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourses()
    {
        return $this->courses;
    }
}
