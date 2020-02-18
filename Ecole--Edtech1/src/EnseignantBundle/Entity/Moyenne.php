<?php

namespace EnseignantBundle\Entity;

/**
 * Moyenne
 */
class Moyenne
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $m1;

    /**
     * @var float
     */
    private $m2;

    /**
     * @var float
     */
    private $m3;


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
     * Set m1
     *
     * @param float $m1
     *
     * @return Moyenne
     */
    public function setM1($m1)
    {
        $this->m1 = $m1;

        return $this;
    }

    /**
     * Get m1
     *
     * @return float
     */
    public function getM1()
    {
        return $this->m1;
    }

    /**
     * Set m2
     *
     * @param float $m2
     *
     * @return Moyenne
     */
    public function setM2($m2)
    {
        $this->m2 = $m2;

        return $this;
    }

    /**
     * Get m2
     *
     * @return float
     */
    public function getM2()
    {
        return $this->m2;
    }

    /**
     * Set m3
     *
     * @param float $m3
     *
     * @return Moyenne
     */
    public function setM3($m3)
    {
        $this->m3 = $m3;

        return $this;
    }

    /**
     * Get m3
     *
     * @return float
     */
    public function getM3()
    {
        return $this->m3;
    }
}

