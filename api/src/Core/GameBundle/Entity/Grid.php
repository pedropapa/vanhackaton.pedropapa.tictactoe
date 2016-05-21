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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Core\GameBundle\Entity\PlayerGrid", mappedBy="grid")
     */
    private $gridPlayers;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Core\GameBundle\Entity\GridCheck", mappedBy="grid")
     */
    private $gridChecks;

    /**
     * @var \Core\GameBundle\Entity\Player
     * @ORM\ManyToOne(targetEntity="\Core\GameBundle\Entity\Player", inversedBy="wins")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="co_player_winner", referencedColumnName="co_player", nullable=true)
     * })
     */
    private $winner;

    /**
     * @var bool
     *
     * @ORM\Column(name="fl_tied", type="boolean", nullable=true)
     */
    private $isTied;

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

    /**
     * Set winner
     *
     * @param \Core\GameBundle\Entity\Player $winner
     * @return Grid
     */
    public function setWinner(\Core\GameBundle\Entity\Player $winner = null)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return \Core\GameBundle\Entity\Player 
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set isTied
     *
     * @param boolean $isTied
     * @return Grid
     */
    public function setIsTied($isTied)
    {
        $this->isTied = $isTied;

        return $this;
    }

    /**
     * Get isTied
     *
     * @return boolean 
     */
    public function getIsTied()
    {
        return $this->isTied;
    }

    /**
     * Add gridChecks
     *
     * @param \Core\GameBundle\Entity\GridCheck $gridChecks
     * @return Grid
     */
    public function addGridCheck(\Core\GameBundle\Entity\GridCheck $gridChecks)
    {
        $this->gridChecks[] = $gridChecks;

        return $this;
    }

    /**
     * Remove gridChecks
     *
     * @param \Core\GameBundle\Entity\GridCheck $gridChecks
     */
    public function removeGridCheck(\Core\GameBundle\Entity\GridCheck $gridChecks)
    {
        $this->gridChecks->removeElement($gridChecks);
    }

    /**
     * Get gridChecks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGridChecks()
    {
        return $this->gridChecks;
    }
}
