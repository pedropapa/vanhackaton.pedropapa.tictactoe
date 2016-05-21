<?php

namespace Core\GameBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Grid
 *
 * @ORM\Table(name="tb_grid")
 * @ORM\Entity(repositoryClass="Core\GameBundle\Repository\GridRepository")
 * @Doctrine\Common\Annotations\Annotation\IgnoreAnnotation("innerEntity")
 */
class Grid extends \Belka\BizlayBundle\Entity\AbstractEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="co_grid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="fl_active", type="boolean")
     */
    private $isActive = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_create", type="datetime")
     */
    private $dtCreate;

    /**
     * @var \Core\GameBundle\Entity\UltimateGrid
     * @ORM\ManyToOne(targetEntity="\Core\GameBundle\Entity\UltimateGrid", inversedBy="grids")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="co_ultimate_grid", referencedColumnName="co_ultimate_grid", nullable=true)
     * })
     */
    private $ultimateGrid;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Core\GameBundle\Entity\PlayerGrid", mappedBy="grid")
     */
    private $gridPlayers;

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
     * @return Grid
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
     * @return Grid
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
     * Set ultimateGrid
     *
     * @param \Core\GameBundle\Entity\UltimateGrid $ultimateGrid
     * @return Grid
     */
    public function setUltimateGrid(\Core\GameBundle\Entity\UltimateGrid $ultimateGrid = null)
    {
        $this->ultimateGrid = $ultimateGrid;

        return $this;
    }

    /**
     * Get ultimateGrid
     *
     * @return \Core\GameBundle\Entity\UltimateGrid 
     */
    public function getUltimateGrid()
    {
        return $this->ultimateGrid;
    }

    /**
     * Add gridPlayers
     *
     * @param \Core\GameBundle\Entity\PlayerGrid $gridPlayers
     * @return Grid
     */
    public function addGridPlayer(\Core\GameBundle\Entity\PlayerGrid $gridPlayers)
    {
        $this->gridPlayers[] = $gridPlayers;

        return $this;
    }

    /**
     * Remove gridPlayers
     *
     * @param \Core\GameBundle\Entity\PlayerGrid $gridPlayers
     */
    public function removeGridPlayer(\Core\GameBundle\Entity\PlayerGrid $gridPlayers)
    {
        $this->gridPlayers->removeElement($gridPlayers);
    }

    /**
     * Get gridPlayers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGridPlayers()
    {
        return $this->gridPlayers;
    }
}
