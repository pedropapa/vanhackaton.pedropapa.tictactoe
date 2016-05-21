<?php

namespace Core\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerGrid
 *
 * @ORM\Table(name="tb_player_grid")
 * @ORM\Entity(repositoryClass="Core\GameBundle\Repository\PlayerGridRepository")
 */
class PlayerGrid
{
    /**
     * @var int
     *
     * @ORM\Column(name="co_player_grid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Core\GameBundle\Entity\Grid
     * @ORM\ManyToOne(targetEntity="\Core\GameBundle\Entity\Grid", inversedBy="gridPlayers")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="co_grid", referencedColumnName="co_grid")
     * })
     */
    private $grid;

    /**
     * @var \Core\GameBundle\Entity\Player
     * @ORM\ManyToOne(targetEntity="\Core\GameBundle\Entity\Player", inversedBy="playerGrids")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="co_player", referencedColumnName="co_player")
     * })
     */
    private $player;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

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
     * @return PlayerGrid
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
     * @return PlayerGrid
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
     * @return PlayerGrid
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
     * @return PlayerGrid
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
}
