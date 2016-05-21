<?php

namespace Core\GameBundle\Controller;

use \FOS\RestBundle\Controller\Annotations as Rest;
use \Belka\CrudBundle\Controller\ControllerRestCrudAbstract;

/**
 *******************************************************
 * ATENÇÃO: REGRAS DE NEGÓCIO FICAM NA CAMADA SERVICE! *
 *******************************************************
 * Controller para a service gridcheck.service.*
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
 * @Rest\Prefix("gridcheck")
 * @Rest\NamePrefix("api_gridcheck_")
 ******************************************************/
class GridCheckController extends GameController
{
}
