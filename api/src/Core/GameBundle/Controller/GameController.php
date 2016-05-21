<?php

namespace Core\GameBundle\Controller;

use Belka\BizlayBundle\Service\ServiceDto;
use Core\GameBundle\Entity\Player;
use \FOS\RestBundle\Controller\Annotations as Rest;
use \Belka\CrudBundle\Controller\ControllerRestCrudAbstract;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use \JMS\DiExtraBundle\Annotation as DI;

class GameController extends ControllerRestCrudAbstract
{
    /**
     * @var TokenStorage
     */
    public $securityTokenStorage;

    /**
     * @var Player
     */
    private $sessionPlayer = null;

    /**
     * @var ContainerInterface
     */
    public $container;
    
    /**
     * Get logged in session player.
     *
     * @return Player
     */
    protected function getSessionPlayer()
    {
        /** @var TokenStorage securityTokenStorage */
        $this->securityTokenStorage = $this->container->get('security.token_storage');

        /** @var Player $player */
        $player = $this->securityTokenStorage->getToken()->getUser();

        /** @var ServiceDto $dto */
        $dto = $this->getDto();

        $dto->request->set('player', $player);

        return $player;
    }
}
