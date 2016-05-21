<?php

namespace Core\GameBundle\Controller;

use Belka\BizlayBundle\Service\ServiceDto;
use Core\GameBundle\Entity\Player;
use Core\GameBundle\Service\GridService;
use \FOS\RestBundle\Controller\Annotations as Rest;
use \Belka\CrudBundle\Controller\ControllerRestCrudAbstract;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 *******************************************************
 * ATENÇÃO: REGRAS DE NEGÓCIO FICAM NA CAMADA SERVICE! *
 *******************************************************
 * Controller para a service grid.service.*
 *******************************************************
 * Utiliza o CrudBundle para criação de CRUDS.         *
 * Os métodos abaixo podem ser sobrescritos conforme   *
 * a necessidade do caso de uso (Controle de acesso,   *
 * disponibilidade da ação de acordo com status do     *
 * item, etc).                                         *
 *                                                     *
 * Deve-se também sobrescrever qualquer action que não *
 * deva estar disponível.                              *
 *******************************************************
 * @Rest\Prefix("grid")
 * @Rest\NamePrefix("api_grid_")
 ******************************************************/
class GridController extends GameController
{
    /**
     * @var TokenStorage
     */
    public $securityTokenStorage;

    /**
     * @inheritdoc
     *
     * @return GridService
     */
    protected function getService()
    {
        return parent::getService();
    }

    public function postCreateAction()
    {
        /** @var ServiceDto $dto */
        $dto = $this->getDto();

        return $this->getService()->save($dto);
    }

    public function postJoinAction()
    {
        /** @var ServiceDto $dto */
        $dto = $this->getDto();

        $this->getService()->postSave($dto);
    }
}
