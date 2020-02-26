<?php

namespace EnseignantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bulletin
 *
 * @ORM\Table(name="bulletin")
 * @ORM\Entity(repositoryClass="EnseignantBundle\Repository\BulletinRepository")
 */
class Bulletin
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
     * @var int
     *
     * @ORM\Column(name="eleve", type="integer")
     */
    private $eleve;

    /**
     * @return int
     */
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * @param int $eleve
     */
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;
    }

    /**
     * @var float
     *
     * @ORM\Column(name="moyenne", type="float", nullable=true)
     */
    private $moyenne;


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
     * Set moyenne
     *
     * @param float $moyenne
     *
     * @return Bulletin
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

