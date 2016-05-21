<?php

namespace Core\GameBundle\Controller;

use Belka\BizlayBundle\Service\ServiceDto;
use Core\GameBundle\Entity\Grid;
use Core\GameBundle\Entity\Player;
use Core\GameBundle\Entity\PlayerGrid;
use Core\GameBundle\Service\GridService;
use Core\GameBundle\Service\PlayerGridService;
use \FOS\RestBundle\Controller\Annotations as Rest;
use \Belka\CrudBundle\Controller\ControllerRestCrudAbstract;
use JMS\DiExtraBundle\Annotation\Service;
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
        $dto = new ServiceDto();

        /** @var PlayerGridService $playerGridService */
        $playerGridService = $this->get('playergrid.service');

        /** @var Player $loggedPlayer */
        $loggedPlayer = $this->getSessionPlayer();

        /** @var Grid $grid */
        $grid = $this->getService()->getGrid();

        $this->getService()->flushRootEntity($dto);

        $dto->request->set('player', $loggedPlayer);
        $dto->request->set('grid', $grid);

        $playerGridService->save($dto);

        return array(
            'success' => true,
            'playerGrid' => $playerGridService->getRootEntityData()
        );
    }

    public function postJoinAction()
    {
        /** @var ServiceDto $dto */
        $dto = $this->getDto();

        /** @var PlayerGridService $playerGridService */
        $playerGridService = $this->get('playergrid.service');

        if($dto->request->has('grid')) {
            /** @var Player $loggedPlayer */
            $loggedPlayer = $this->getSessionPlayer();

            /** @var array $grid */
            $grid = $dto->request->get('grid');

            if($playerGridService->isValidPlayerGrid($loggedPlayer, $grid)) {
                /** @var PlayerGrid $playerGrid */
                $playerGrid = $playerGridService->joinPlayerGrid($loggedPlayer, $this->getService()->getGrid());

                return array(
                    'success' => true,
                    'playerGrid' => $playerGrid
                );
            } else {
                throw new \Exception("Not a valid player grid.");
            }
        } else {
            throw new \Exception("Grid must be informed.");
        }
    }
}
