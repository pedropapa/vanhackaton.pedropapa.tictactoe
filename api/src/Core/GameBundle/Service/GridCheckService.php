<?php

namespace Core\GameBundle\Service;

use \Belka\BizlayBundle\Service\ServiceDto;
use \Belka\CrudBundle\Service\AbstractEntityService;
use Core\GameBundle\Entity\Grid;
use Core\GameBundle\Entity\GridCheck;
use Core\GameBundle\Entity\Player;
use Doctrine\Common\Collections\Collection;
use \JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


/**
 *******************************************************
 * ATENÇÃO: QUALQUER INTERAÇÂO COM A VIEW FICA NA      *
 * CAMADA CONTROLLER! (JSON, HTML, ETC)                *
 *******************************************************
 * Service para manipular a entidade GridCheck      *
 *******************************************************
 * Utiliza o CrudBundle para criação de CRUDS.         *
 * Os métodos abaixo podem ser sobrescritos conforme   *
 * a necessidade do caso de uso (Filtragem, Validação, *
 * verificação, uploads, e ações pós persistência).    *
 *                                                     *
 * Deve-se também sobrescrever qualquer método que não *
 * deva estar disponível, tais como o removeEntity.    *
 *******************************************************
 * @DI\Service("gridcheck.service")
 ******************************************************/
class GridCheckService extends AbstractEntityService
{
    /**
     * {@inheritdoc}
     */
    public $debug = false;

    /**
     * @var integer
     *
     * @DI\Inject("%max_grid_cols%")
     */
    public $max_grid_cols;

    /**
     * @var integer
     *
     * @DI\Inject("%max_grid_rows%")
     */
    public $max_grid_rows;

    /**
     * @var integer
     *
     * @DI\Inject("%max_grid_players%")
     */
    public $max_grid_players;

    /**
     * @var TokenStorage
     *
     * @DI\Inject("security.token_storage")
     */
    public $securityTokenStorage;

    /**
     * @var GridService
     *
     * @DI\Inject("grid.service")
     */
    public $gridService;

    /**
     * @var PlayerGridService
     *
     * @DI\Inject("playergrid.service")
     */
    public $playerGridService;

    /**
     * {@inheritdoc}
     *
     * @return \Core\GameBundle\Entity\GridCheck
     */
    protected function getRootEntity($id = null)
    {
        return parent::getRootEntity($id);
    }

    /**
     * {@inheritdoc}
     *
     * @return \Core\GameBundle\Repository\GridCheckRepository
     */
    protected function getRootRepository()
    {
        return parent::getRootRepository();
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
        /** @var Player $player */
        $player = $this->securityTokenStorage->getToken()->getUser();

        $dto->request->set('player', $player);
    }

    /**
     * Método para lidar com toda e qualquer situação XGH que não se adeque nas anteriores
     *
     * @example  Entidades que não são acessíveis pela estrutura da RootEntity
     */
    public function preFlush(ServiceDto $dto)
    {
        $gridCheck = $this->getRootEntity();

        $gridCheck->getGrid()->addGridCheck($gridCheck);

        $grid = $this->gridService->flushGridResult($gridCheck->getGrid());

        $gridCheck->setGrid($grid);
    }

    /**
     * {@inheritdoc}
     */
    public function validateRootEntity(ServiceDto $dto)
    {
        if($dto->request->has('grid')) {
            $grid = $dto->request->get('grid');

            if(!isset($grid['id'])) {
                throw new \Exception("Grid id must be informed.");
            }

            if($dto->request->has('colPos') && $dto->request->has('rowPos')) {
                $colpos = $dto->request->get('colPos');
                $rowpos = $dto->request->get('rowPos');

                if(is_integer($colpos) && is_integer($rowpos)) {
                    if(($colpos > 0 && $colpos <= $this->max_grid_cols) && ($rowpos > 0 && $rowpos <= $this->max_grid_rows)) {
                        return true;
                    } else {
                        throw new \Exception("Invalid position.");
                    }
                } else {
                    throw new \Exception("Not a valid position value.");
                }
            } else {
                throw new \Exception("Position must be informed.");
            }
        } else {
            throw new \Exception("Grid must be informed.");
        }
    }

    /**
     * {@inheritdoc}
     */
    public function verifyRootEntity(ServiceDto $dto)
    {
        $grid = $dto->request->get('grid');
        $gridId = $grid['id'];

        $colpos = $dto->request->get('colPos');
        $rowpos = $dto->request->get('rowPos');

        /** @var Grid $grid */
        $grid = $this->gridService->getRootEntity($gridId);

        if(!$grid) {
            throw new \Exception("Invalid grid.");
        }

        if($this->gridService->isGridFinished($grid)) {
            throw new \Exception("Grid is finished already");
        }

        if(count($grid->getGridPlayers()) !== $this->max_grid_players) {
            throw new \Exception($this->max_grid_players . " players are needed to start up the game.");
        }

        /** @var Player $player */
        $player = $this->securityTokenStorage->getToken()->getUser();

        if(!$this->playerGridService->getPlayerGrid($player, $grid)) {
            throw new \Exception("Player is not joined in the grid.");
        }

        if($this->checkTwiceInARow($player, $grid->getGridChecks())) {
            throw new \Exception("Player can't check twice in a row.");
        }

        $posAlreadyChecked = $this->getGridByPos($grid, $colpos, $rowpos);

        if($posAlreadyChecked instanceof GridCheck) {
            throw new \Exception("Position already Checked");
        }
    }

    public function getGridByPos(Grid $grid, $colpos, $rowpos)
    {
        return $this->getRootRepository()->getGridByPos($grid, $colpos, $rowpos);
    }
    
    public function getGridFromGridCheck()
    {
        return $this->rootEntity->getGrid();
    }

    private function checkTwiceInARow(Player $player, Collection $gridChecks)
    {
        $gridChecksArray = $gridChecks->toArray();

        $lastCheck = end($gridChecksArray);

        if($lastCheck) {
            if($lastCheck->getPlayer() && $lastCheck->getPlayer() == $player) {
                return true;
            }
        }
    }
}
