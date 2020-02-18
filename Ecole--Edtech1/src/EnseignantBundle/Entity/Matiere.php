<?php

namespace EnseignantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matiere
 *
 * @ORM\Table(name="matiere")
 * @ORM\Entity(repositoryClass="EnseignantBundle\Repository\MatiereRepository")
 */
class Matiere
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="nbH", type="integer")
     */
    private $nbH;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Matiere
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nbH
     *
     * @param integer $nbH
     *
     * @return Matiere
     */
    public function setNbH($nbH)
    {
        $this->nbH = $nbH;

        return $this;
    }

    /**
     * Get nbH
     *
     * @return int
     */
    public function getNbH()
    {
        return $this->nbH;
    }

    /**
     * @ORM\OneToMany(targetEntity="Notes", mappedBy="matiere")
     */
    private $notes;

    /**
     * @return ArrayCollection
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param ArrayCollection $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public  function __toString()
    {
        return $this->getNom();
    }
}

