<?php

namespace EnseignantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notes
 *
 * @ORM\Table(name="notes")
 * @ORM\Entity(repositoryClass="EnseignantBundle\Repository\NotesRepository")
 */
class Notes
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
     * @ORM\Column(name="type", type="string", length=255)
     */

    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="valeur", type="float")
     */

    private $valeur;

    /**
     * @var int
     *
     * @ORM\Column(name="id_trimestre", type="integer")
     */
    private $id_trimestre;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="notes")
     * @ORM\JoinColumn(name="enseignant_id",referencedColumnName="id")
     */
    private $enseignant;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="noteseleve")
     * @ORM\JoinColumn(name="eleve_id",referencedColumnName="id")
     */
    private $eleve;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return float
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * @param float $valeur
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    }

    /**
     * @return int
     */
    public function getIdTrimestre()
    {
        return $this->id_trimestre;
    }

    /**
     * @param int $id_trimestre
     */
    public function setIdTrimestre($id_trimestre)
    {
        $this->id_trimestre = $id_trimestre;
    }

    /**
     * @return mixed
     */
    public function getEnseignant()
    {
        return $this->enseignant;
    }

    /**
     * @param mixed $enseignant
     */
    public function setEnseignant($enseignant)
    {
        $this->enseignant = $enseignant;
    }

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
     * @ORM\ManyToOne(targetEntity="ScolariteBundle\Entity\Matiere", inversedBy="notes")
     * @ORM\JoinColumn(name="matiere",referencedColumnName="id")
     */
    private $matiere;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public  function __toString()
    {
        return $this->matiere;
    }
}

