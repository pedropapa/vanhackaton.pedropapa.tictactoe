<?php

namespace Core\GameBundle\Service;

use \Belka\BizlayBundle\Service\ServiceDto;
use \Belka\CrudBundle\Service\AbstractEntityService;
use Core\GameBundle\Entity\Grid;
use Core\GameBundle\Entity\Player;
use \JMS\DiExtraBundle\Annotation as DI;


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
}
