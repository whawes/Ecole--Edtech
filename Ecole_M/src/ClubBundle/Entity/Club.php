<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Club
 *
 * @ORM\Table(name="club")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubRepository")
 */
class Club
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
     * @ORM\Column(name="nomclub", type="string", length=255)
     */
    private $nomclub;


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */

    private $User;


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
     * Set nomclub
     *
     * @param string $nomclub
     *
     * @return Club
     */
    public function setNomclub($nomclub)
    {
        $this->nomclub = $nomclub;

        return $this;
    }

    /**
     * Get nomclub
     *
     * @return string
     */
    public function getNomclub()
    {
        return $this->nomclub;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Club
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->User = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->User;
    }
}
