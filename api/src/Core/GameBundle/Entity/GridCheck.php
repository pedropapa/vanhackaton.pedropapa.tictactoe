<?php

namespace Core\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GridCheck
 *
 * @ORM\Table(name="tb_grid_check")
 * @ORM\Entity(repositoryClass="Core\GameBundle\Repository\GridCheckRepository")
 * @Doctrine\Common\Annotations\Annotation\IgnoreAnnotation("innerEntity")
 */
class GridCheck extends \Belka\BizlayBundle\Entity\AbstractEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="co_grid_check", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Core\GameBundle\Entity\Grid
     * @ORM\ManyToOne(targetEntity="\Core\GameBundle\Entity\Grid")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="co_grid", referencedColumnName="co_grid", nullable=true)
     * })
     */
    private $grid;

    /**
     * @var \Core\GameBundle\Entity\Player
     * @ORM\ManyToOne(targetEntity="\Core\GameBundle\Entity\Player")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="co_player", referencedColumnName="co_player", nullable=true)
     * })
     */
    private $player;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive = true;

    /**
     * @var integer
     *
     * @ORM\Column(name="nu_col_pos", type="integer")
     */
    private $colPos;

    /**
     * @var integer
     *
     * @ORM\Column(name="nu_row_pos", type="integer")
     */
    private $rowPos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_create", type="datetime")
     */
    private $dtCreate;

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
     * @return GridCheck
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
     * @return GridCheck
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
     * Set grid
     *
     * @param \Core\GameBundle\Entity\Grid $grid
     * @return GridCheck
     */
    public function setGrid(\Core\GameBundle\Entity\Grid $grid = null)
    {
        $this->grid = $grid;

        return $this;
    }

    /**
     * Get grid
     *
     * @return \Core\GameBundle\Entity\Grid 
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * Set player
     *
     * @param \Core\GameBundle\Entity\Player $player
     * @return GridCheck
     */
    public function setPlayer(\Core\GameBundle\Entity\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \Core\GameBundle\Entity\Player 
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set colPos
     *
     * @param integer $colPos
     * @return GridCheck
     */
    public function setColPos($colPos)
    {
        $this->colPos = $colPos;

        return $this;
    }

    /**
     * Get colPos
     *
     * @return integer 
     */
    public function getColPos()
    {
        return $this->colPos;
    }

    /**
     * Set rowPos
     *
     * @param integer $rowPos
     * @return GridCheck
     */
    public function setRowPos($rowPos)
    {
        $this->rowPos = $rowPos;

        return $this;
    }

    /**
     * Get rowPos
     *
     * @return integer 
     */
    public function getRowPos()
    {
        return $this->rowPos;
    }
}
