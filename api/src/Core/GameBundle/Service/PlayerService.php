<?php

namespace Core\GameBundle\Service;

use \Belka\BizlayBundle\Service\ServiceDto;
use \Belka\CrudBundle\Service\AbstractEntityService;
use Core\GameBundle\Entity\Player;
use AppBundle\Security\Authentication\Token\LoginToken;
use \JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


/**
 *******************************************************
 * ATENÇÃO: QUALQUER INTERAÇÂO COM A VIEW FICA NA      *
 * CAMADA CONTROLLER! (JSON, HTML, ETC)                *
 *******************************************************
 * Service para manipular a entidade Player      *
 *******************************************************
 * Utiliza o CrudBundle para criação de CRUDS.         *
 * Os métodos abaixo podem ser sobrescritos conforme   *
 * a necessidade do caso de uso (Filtragem, Validação, *
 * verificação, uploads, e ações pós persistência).    *
 *                                                     *
 * Deve-se também sobrescrever qualquer método que não *
 * deva estar disponível, tais como o removeEntity.    *
 *******************************************************
 * @DI\Service("player.service")
 ******************************************************/
class PlayerService extends AbstractEntityService
{
    /**
     * {@inheritdoc}
     */
    public $debug = false;

    /**
     * @var TokenStorage
     *
     * @DI\Inject("security.token_storage")
     */
    public $securityTokenStorage;

    /**
     * @var Session
     *
     * @DI\Inject("session")
     */
    public $session;

    /**
     * @var Container
     *
     * @DI\Inject("service_container")
     */
    public $container;

    /**
     * @inheritdoc

     * @return Player
     */
    protected function getRootEntity($id = null)
    {
        return parent::getRootEntity($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getFormData($entityData = null)
    {
        return parent::getFormData($entityData);
    }

    /**
     * {@inheritdoc}
     */
    public function preSave(ServiceDto $dto)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function validateRootEntity(ServiceDto $dto)
    {
        if(!$dto->request->has('dsName')) {
            throw new \Exception("Invalid params");
        }
    }

    /**
     * {@inheritdoc}
     */
    public function preFlush(ServiceDto $dto)
    {
        // Set player's identifier key (not currently used in the project, it should be used on the front-end).
        $this->getRootEntity()->setDsKey(md5(rand(0, 10000000000000)));
    }

    /**
     * {@inheritdoc}
     */
    public function postSave(ServiceDto $dto)
    {
        if($this->securityTokenStorage->getToken() && $this->securityTokenStorage->getToken()->getUser() instanceof Player) {
            $this->securityTokenStorage->setToken(null);
            $this->session->invalidate();
        }

        $token = new LoginToken($this->getRootEntity(), array($this->container->getParameter('default_role')));
        $this->securityTokenStorage->setToken($token);
    }
}
