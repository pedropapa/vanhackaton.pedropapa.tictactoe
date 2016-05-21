<?php

namespace Core\GameBundle\Service;

use \Belka\BizlayBundle\Service\ServiceDto;
use \Belka\CrudBundle\Service\AbstractEntityService;
use Core\GameBundle\Entity\Grid;
use Core\GameBundle\Entity\Player;
use Core\GameBundle\Entity\PlayerGrid;
use Doctrine\Common\Collections\ArrayCollection;
use \JMS\DiExtraBundle\Annotation as DI;


/**
 *******************************************************
 * ATENÇÃO: QUALQUER INTERAÇÂO COM A VIEW FICA NA      *
 * CAMADA CONTROLLER! (JSON, HTML, ETC)                *
 *******************************************************
 * Service para manipular a entidade PlayerGrid      *
 *******************************************************
 * Utiliza o CrudBundle para criação de CRUDS.         *
 * Os métodos abaixo podem ser sobrescritos conforme   *
 * a necessidade do caso de uso (Filtragem, Validação, *
 * verificação, uploads, e ações pós persistência).    *
 *                                                     *
 * Deve-se também sobrescrever qualquer método que não *
 * deva estar disponível, tais como o removeEntity.    *
 *******************************************************
 * @DI\Service("playergrid.service")
 ******************************************************/
class PlayerGridService extends AbstractEntityService
{
    /**
     * {@inheritdoc}
     */
    public $debug = false;

    /**
     * @var GridService
     *
     * @DI\Inject("grid.service")
     */
    public $gridService;

    /**
     * @var integer
     *
     * @DI\Inject("%max_grid_players%")
     */
    public $max_grid_players;

    /**
     * {@inheritdoc}
     *
     * @return \Core\GameBundle\Repository\PlayerGridRepository
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
     * Get Player Grid
     *
     * @param Player $grid
     * @param Grid $grid
     */
    public function getPlayerGrid(Player $player, Grid $grid) {
        return $this->getRootRepository()->getPlayerGrid($player, $grid);
    }

    public function joinPlayerGrid(Player $player, Grid $grid)
    {
        /** @var ArrayCollection $gridPlayers */
        $gridPlayers = $this->getGridPlayers($grid);

        if(count($gridPlayers) < $this->max_grid_players) {
            $playerAlreadyOnGrid = $this->getPlayerGrid($player, $grid);

            if(!$playerAlreadyOnGrid) {
                /** @var Grid $newGrid */
                $newGrid = $this->addGridPlayer($player, $grid);

                $this->getEntityManager()->flush();

                return $newGrid;
            } else {
                throw new \Exception("Player is already on this grid.");
            }
        } else {
            throw new \Exception("Too many players on the same grid.");
        }
    }

    public function isValidPlayerGrid(Player $player, array $grid)
    {
        if(isset($grid['id'])) {
            $gridId = $grid['id'];

            /** @var Grid $grid */
            $grid = $this->gridService->getRootEntity($gridId);

            if(!$grid) {
                return false;
            }

            if($this->getPlayerGrid($player, $grid)) {
                // If player is already in the grid, we invalidate the action.
                return false;
            } else {
                // If player is not in the grid already, proceed with the joining.
                return true;
            }
        } else {
            throw new \Exception("Grid id must be informed");
        }
    }

    public function getGridPlayers(Grid $grid)
    {
        return $this->getRootRepository()->getGridPlayers($grid);
    }

    public function addGridPlayer(Player $player, Grid $grid)
    {
        $playerGrid = new PlayerGrid();

        $playerGrid->setGrid($grid);
        $playerGrid->setPlayer($player);

        $this->getEntityManager()->persist($playerGrid);

        return $grid->addGridPlayer($playerGrid);
    }
}
