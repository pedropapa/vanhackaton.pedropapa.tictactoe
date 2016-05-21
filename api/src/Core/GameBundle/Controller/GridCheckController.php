<?php

namespace Core\GameBundle\Controller;

use Belka\BizlayBundle\Entity\Exception\ValidationException;
use Belka\BizlayBundle\Service\ServiceDto;
use Belka\CrudBundle\Service\Exception\EntityException;
use Belka\CrudBundle\Service\Exception\HandleUploadsException;
use Belka\CrudBundle\Service\Exception\UniqueException;
use Belka\CrudBundle\Service\Exception\VerificationException;
use Core\GameBundle\Entity\Player;
use \FOS\RestBundle\Controller\Annotations as Rest;
use \Belka\CrudBundle\Controller\ControllerRestCrudAbstract;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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
    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function postSaveAction()
    {
        /** @var ServiceDto $clientDto */
        $clientDto = $this->getDto();

        $dto = new ServiceDto();
        
        // We want only colpos, rowpos and grid to be passed to the service.
        $dto->request->set('colPos', $clientDto->request->get('colPos'));
        $dto->request->set('rowPos', $clientDto->request->get('rowPos'));
        $dto->request->set('grid', $clientDto->request->get('grid'));

        try {
            $this->getService()->save($dto);
            return $this->getService()->getGridFromGridCheck();
        } catch (UniqueException $e) {
            throw new BadRequestHttpException($e->getMessage());
        } catch (ValidationException $e) {
            throw new BadRequestHttpException($e->getMessage());
        } catch (VerificationException $e) {
            throw new BadRequestHttpException($e->getMessage());
        } catch (HandleUploadsException $e) {
            throw new BadRequestHttpException($e->getMessage());
        } catch (EntityException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }
}
