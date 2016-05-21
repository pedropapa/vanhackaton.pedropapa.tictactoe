<?php

namespace Core\GameBundle\Service;

use AppBundle\Helper\Combinations;
use \Belka\BizlayBundle\Service\ServiceDto;
use \Belka\CrudBundle\Service\AbstractEntityService;
use Core\GameBundle\Entity\Grid;
use Core\GameBundle\Entity\GridCheck;
use Core\GameBundle\Entity\Player;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use \JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Debug\Tests\Fixtures\DeprecatedClass;


/**
 *******************************************************
 * ATENÇÃO: QUALQUER INTERAÇÂO COM A VIEW FICA NA      *
 * CAMADA CONTROLLER! (JSON, HTML, ETC)                *
 *******************************************************
 * Service para manipular a entidade Grid      *
 *******************************************************
 * Utiliza o CrudBundle para criação de CRUDS.         *
 * Os métodos abaixo podem ser sobrescritos conforme   *
 * a necessidade do caso de uso (Filtragem, Validação, *
 * verificação, uploads, e ações pós persistência).    *
 *                                                     *
 * Deve-se também sobrescrever qualquer método que não *
 * deva estar disponível, tais como o removeEntity.    *
 *******************************************************
 * @DI\Service("grid.service")
 ******************************************************/
class GridService extends AbstractEntityService
{
    /**
     * {@inheritdoc}
     */
    public $debug = false;

    /**
     * @var PlayerGridService
     * @DI\Inject("playergrid.service")
     */
    public $playerGridService;

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

    public $magic_square  = array(
        array(4, 3, 8),
        array(9, 5, 1),
        array(2, 7, 6)
    );

    public function getGrid()
    {
        return $this->getRootEntity();
    }

    public function isGridFinished(Grid $grid)
    {
        if($grid->getWinner() instanceof Player || $grid->getIsTied()) {
            return true;
        }

        return false;
    }

    public function flushGridResult(Grid $grid)
    {
        $gridChecks = $grid->getGridChecks();

        $playerPoints = array();

        /** @var GridCheck $gridCheck */
        foreach($gridChecks as $gridCheck) {
            $playerId = $gridCheck->getPlayer()->getId();

            if(!isset($playerPoints[$playerId])) {
                $playerPoints[$playerId] = array();
            }

            $colPos = $gridCheck->getColPos() - 1;
            $rowPos = $gridCheck->getRowPos() - 1;

            $points = $this->magic_square[$rowPos][$colPos];

            $playerPoints[$playerId][] = $points;

            if(count($playerPoints[$playerId]) >= 3) {
                $combinations = new Combinations($playerPoints[$playerId], 3);

                foreach($combinations as $array) {
                    if(array_sum($array) == 15) {
                        $grid->setWinner($gridCheck->getPlayer());
                    }
                }
            }
        }

        if(count($gridChecks) >= 7 && !($grid->getWinner() instanceof Player)) {
            $grid->setIsTied(true);
        }

        return $grid;
    }
}
