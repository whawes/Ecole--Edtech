<?php

namespace EnseignantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moyenne
 *
 * @ORM\Table(name="moyenne")
 * @ORM\Entity(repositoryClass="EnseignantBundle\Repository\MoyenneRepository")
 */
class Moyenne
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
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * ORM\JoinColumn(name="eleve",referencedColumnName=Id)
     */
    private $eleve;

    /**
     * @var int
     *
     * @ORM\Column(name="trimestre", type="integer")
     */
    private $trimestre;

    /**
     * @var float
     *
     * @ORM\Column(name="moyenne", type="float", nullable=true)
     */
    private $moyenne;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="ScolariteBundle\Entity\Matiere")
     * ORM\JoinColumn(name="matiere",referencedColumnName=Id)
     */
    private $matiere;

    /**
     * @return mixed
     */
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * @param mixed $eleve
     */
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;
    }

    /**
     * @return mixed
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param mixed $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
    }


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
     * Set trimestre
     *
     * @param integer $trimestre
     *
     * @return Moyenne
     */
    public function setTrimestre($trimestre)
    {
        $this->trimestre = $trimestre;

        return $this;
    }

    /**
     * Get trimestre
     *
     * @return int
     */
    public function getTrimestre()
    {
        return $this->trimestre;
    }

    /**
     * Set moyenne
     *
     * @param float $moyenne
     *
     * @return Moyenne
     */
    public function setMoyenne($moyenne)
    {
        $this->moyenne = $moyenne;

        return $this;
    }

    /**
     * Get moyenne
     *
     * @return float
     */
    public function getMoyenne()
    {
        return $this->moyenne;
    }


}

