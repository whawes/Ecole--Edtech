<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permutation
 *
 * @ORM\Table(name="permutation")
 * @ORM\Entity(repositoryClass="GestionBundle\Repository\PermutationRepository")
 */
class Permutation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", length=255)
     */
    private $niveau;

    /**
     * @var string
     *
     * @ORM\Column(name="classe_o", type="string", length=255)
     */
    private $classeO;

    /**
     * @var string
     *
     * @ORM\Column(name="classe_s", type="string", length=255)
     */
    private $classeS;

    /**
     * @var string
     *
     * @ORM\Column(name="raison", type="string", length=255)
     */
    private $raison;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @var int
     *
     * @ORM\Column(name="iduser", type="integer")
     */
    private $iduser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set niveau
     *
     * @param string $niveau
     *
     * @return Permutation
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set classeO
     *
     * @param string $classeO
     *
     * @return Permutation
     */
    public function setClasseO($classeO)
    {
        $this->classeO = $classeO;

        return $this;
    }

    /**
     * Get classeO
     *
     * @return string
     */
    public function getClasseO()
    {
        return $this->classeO;
    }

    /**
     * Set classeS
     *
     * @param string $classeS
     *
     * @return Permutation
     */
    public function setClasseS($classeS)
    {
        $this->classeS = $classeS;

        return $this;
    }

    /**
     * Get classeS
     *
     * @return string
     */
    public function getClasseS()
    {
        return $this->classeS;
    }

    /**
     * Set raison
     *
     * @param string $raison
     *
     * @return Permutation
     */
    public function setRaison($raison)
    {
        $this->raison = $raison;

        return $this;
    }

    /**
     * Get raison
     *
     * @return string
     */
    public function getRaison()
    {
        return $this->raison;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Permutation
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set iduser
     *
     * @param integer $iduser
     *
     * @return Permutation
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return int
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Permutation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}

