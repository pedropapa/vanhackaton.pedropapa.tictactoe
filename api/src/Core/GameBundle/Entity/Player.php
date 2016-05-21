<?php

namespace Core\GameBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Player
 *
 * @ORM\Table(name="tb_player")
 * @ORM\Entity(repositoryClass="Core\GameBundle\Repository\PlayerRepository")
 * @Doctrine\Common\Annotations\Annotation\IgnoreAnnotation("innerEntity")
 */
class Player extends \Belka\BizlayBundle\Entity\AbstractEntity implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="co_player", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_create", type="datetime")
     */
    private $dtCreate;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive = true;

    /**
     * @var string
     *
     * @ORM\Column(name="ds_name", type="string", length=50)
     */
    private $dsName;

    /**
     * @var string
     *
     * @ORM\Column(name="ds_key", type="string", length=255, unique=true)
     */
    private $dsKey;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Core\GameBundle\Entity\PlayerGrid", mappedBy="player")
     */
    private $playerGrids;



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
     * Set dtCreate
     *
     * @param \DateTime $dtCreate
     * @return Player
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return Player
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
     * Set dsName
     *
     * @param string $dsName
     * @return Player
     */
    public function setDsName($dsName)
    {
        $this->dsName = $dsName;

        return $this;
    }

    /**
     * Get dsName
     *
     * @return string 
     */
    public function getDsName()
    {
        return $this->dsName;
    }

    /**
     * Set dsKey
     *
     * @param string $dsKey
     * @return Player
     */
    public function setDsKey($dsKey)
    {
        $this->dsKey = $dsKey;

        return $this;
    }

    /**
     * Get dsKey
     *
     * @return string 
     */
    public function getDsKey()
    {
        return $this->dsKey;
    }

    /**
     * Add playerGrids
     *
     * @param \Core\GameBundle\Entity\PlayerGrid $playerGrids
     * @return Player
     */
    public function addPlayerGrid(\Core\GameBundle\Entity\PlayerGrid $playerGrids)
    {
        $this->playerGrids[] = $playerGrids;

        return $this;
    }

    /**
     * Remove playerGrids
     *
     * @param \Core\GameBundle\Entity\PlayerGrid $playerGrids
     */
    public function removePlayerGrid(\Core\GameBundle\Entity\PlayerGrid $playerGrids)
    {
        $this->playerGrids->removeElement($playerGrids);
    }

    /**
     * Get playerGrids
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayerGrids()
    {
        return $this->playerGrids;
    }

    /**
     * @inheritdoc
     */
    public function getRoles() {

    }

    /**
     * @inheritdoc
     */
    public function getPassword() {
        return $this->getDsKey();
    }

    /**
     * @inheritdoc
     */
    public function getSalt() {

    }

    /**
     * @inheritdoc
     */
    public function getUsername()
    {
        return $this->getDsName();
    }

    /**
     * @inheritdoc
     */
    public function eraseCredentials()
    {

    }
}
