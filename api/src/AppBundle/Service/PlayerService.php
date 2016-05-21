<?php

namespace AppBundle\Service;

use \Belka\BizlayBundle\Service\ServiceDto;
use \Belka\CrudBundle\Service\AbstractEntityService;
use \JMS\DiExtraBundle\Annotation as DI;


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
    }

    /**
     * {@inheritdoc}
     */
    public function verifyRootEntity(ServiceDto $dto)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function handleUploads(ServiceDto $dto)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function preFlush(ServiceDto $dto)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function postSave(ServiceDto $dto)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function removeEntity($id)
    {
        return parent::removeEntity($id);
    }

    /**
     * {@inheritdoc}
     */
    public function checkUserEditPermission($item)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function checkUserViewPermission($item)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function checkUserDeletePermission($item)
    {
        return true;
    }
}
