<?php

namespace Core\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table(name="tb_player")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerRepository")
 * @Doctrine\Common\Annotations\Annotation\IgnoreAnnotation("innerEntity")
 */
class Player
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
}
