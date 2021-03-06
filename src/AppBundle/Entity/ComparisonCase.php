<?php

namespace AppBundle\Entity;

/**
 * ComparisonCase.
 */
class ComparisonCase
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $basic;

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return ComparisonCase
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set basic.
     *
     * @param int $basic
     *
     * @return ComparisonCase
     */
    public function setBasic($basic)
    {
        $this->basic = $basic;

        return $this;
    }

    /**
     * Get basic.
     *
     * @return int
     */
    public function getBasic()
    {
        return $this->basic;
    }
    /**
     * @var \AppBundle\Entity\Comparison
     */
    private $comparison;

    /**
     * Set comparison.
     *
     * @param \AppBundle\Entity\Comparison $comparison
     *
     * @return ComparisonCase
     */
    public function setComparison(\AppBundle\Entity\Comparison $comparison = null)
    {
        $this->comparison = $comparison;

        return $this;
    }

    /**
     * Get comparison.
     *
     * @return \AppBundle\Entity\Comparison
     */
    public function getComparison()
    {
        return $this->comparison;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $calcs;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->calcs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add calcs.
     *
     * @param \AppBundle\Entity\ComparisonCaseCalc $calcs
     *
     * @return ComparisonCase
     */
    public function addCalc(\AppBundle\Entity\ComparisonCaseCalc $calcs)
    {
        $this->calcs[] = $calcs;

        return $this;
    }

    /**
     * Remove calcs.
     *
     * @param \AppBundle\Entity\ComparisonCaseCalc $calcs
     */
    public function removeCalc(\AppBundle\Entity\ComparisonCaseCalc $calcs)
    {
        $this->calcs->removeElement($calcs);
    }

    /**
     * Get calcs.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCalcs()
    {
        return $this->calcs;
    }
}
