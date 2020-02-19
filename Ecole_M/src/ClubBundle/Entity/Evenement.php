<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\EvenementRepository")
 */
class Evenement
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
     * @ORM\ManyToOne(targetEntity="ClubBundle\Entity\Club")
     * @ORM\JoinColumn(referencedColumnName="id")
     */

    private $Club;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_evenement", type="string", length=255)
     */
    private $nomEvenement;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_debut", type="datetime")
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_fin", type="datetime")
     */
    private $heureFin;


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
     * Set nomEvenement
     *
     * @param string $nomEvenement
     *
     * @return Evenement
     */
    public function setNomEvenement($nomEvenement)
    {
        $this->nomEvenement = $nomEvenement;

        return $this;
    }

    /**
     * Get nomEvenement
     *
     * @return string
     */
    public function getNomEvenement()
    {
        return $this->nomEvenement;
    }



    /**
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     *
     * @return Evenement
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return \DateTime
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     *
     * @return Evenement
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set club
     *
     * @param \ClubBundle\Entity\Club $club
     *
     * @return Evenement
     */
    public function setClub(\ClubBundle\Entity\Club $club = null)
    {
        $this->Club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return \ClubBundle\Entity\Club
     */
    public function getClub()
    {
        return $this->Club;
    }
}
