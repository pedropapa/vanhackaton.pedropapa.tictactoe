<?php

namespace Core\GameBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * UltimateGrid
 *
 * @ORM\Table(name="tb_ultimate_grid")
 * @ORM\Entity(repositoryClass="Core\GameBundle\Repository\UltimateGridRepository")
 * @Doctrine\Common\Annotations\Annotation\IgnoreAnnotation("innerEntity")
 */
class UltimateGrid
{
    /**
     * @var int
     *
     * @ORM\Column(name="co_ultimate_grid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_create", type="datetime")
     */
    private $dtCreate;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Core\GameBundle\Entity\Grid", mappedBy="ultimateGrid")
     */
    private $grids;

    public function __construct()
    {
        $this->setDtCreate(new \DateTime);
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return UltimateGrid
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set dtCreate
     *
     * @param \DateTime $dtCreate
     * @return UltimateGrid
     */
    public function setDtCreate($dtCreate)
    {
        $this->dtCreate = $dtCreate;

        return $this;
    }

    /**
     * Get dtCreate
     *
     * @return \DateTime 
     */
    public function getDtCreate()
    {
        return $this->dtCreate;
    }

    /**
     * Add grids
     *
     * @param \Core\GameBundle\Entity\Grid $grids
     * @return UltimateGrid
     */
    public function addGrid(\Core\GameBundle\Entity\Grid $grids)
    {
        $this->grids[] = $grids;

        return $this;
    }

    /**
     * Remove grids
     *
     * @param \Core\GameBundle\Entity\Grid $grids
     */
    public function removeGrid(\Core\GameBundle\Entity\Grid $grids)
    {
        $this->grids->removeElement($grids);
    }

    /**
     * Get grids
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGrids()
    {
        return $this->grids;
    }
}
