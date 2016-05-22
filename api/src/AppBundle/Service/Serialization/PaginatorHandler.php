<?php

namespace Core\SystemBundle\Services\Serialization;

use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use JMS\DiExtraBundle\Annotation\Tag;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\VisitorInterface;
use \JMS\DiExtraBundle\Annotation as DI;

/**
 * Serializa objetos Paginator como um objeto com os seguintes atributos:
 *
 * - items: array de resultados da página atual
 * - currentPage: número da página atual, começando em 1
 * - perPage: número de registros por página
 * - numPages: total de páginas
 * - firstPosition: número do primeiro item dos resultados atuais, começando em 1
 * - lastPosition: número do último item dos resultados atuais, começando em 1
 * - total: número de resultados somando todas as páginas
 * @DI\Service("system.paginatorhandler")
 * @Tag("jms_serializer.handler", attributes = {"direction" = "serialization", "format"="json", "type"="Doctrine\ORM\Tools\Pagination\Paginator", "method"="serializePaginator"})
 */
class PaginatorHandler
{
    /** @var \ReflectionProperty */
    private $queryProperty;

    public function serializePaginator(
        VisitorInterface $visitor,
        Paginator $obj,
        array $type,
        Context $context
    ) {
        $out = $this->serialize($obj);
        return $visitor->visitArray($out, $type, $context);
    }

    /**
     * @param Paginator $obj
     * @param null $items
     * @return array
     */
    public function serialize(Paginator $obj, $items = null)
    {
        $total = $obj->count();
        $query = $this->getQuery($obj);
        $offset = (int)$query->getFirstResult();
        $perPage = $query->getMaxResults();

        $out = array();
        $out['items'] = $items ?: iterator_to_array($obj);

        $out['currentPage'] = ($offset > 0) ?$offset / $perPage + 1:1;
        $out['perPage'] = $perPage;
        $out['numPages'] = ($perPage > 0) ? ceil((float)$total / $perPage) : 0;

        $out['firstPosition'] = $offset + 1;
        $out['lastPosition'] = $offset + count($out['items']);
        $out['total'] = $total;
        return $out;
    }

    /**
     * @param Paginator $paginator
     *
     * @return Query
     */
    private function getQuery(Paginator $paginator)
    {
        // hack horrível, mas precisamos da consulta para obter seu offset
        if (!$this->queryProperty) {
            $reflection = new \ReflectionClass('Doctrine\ORM\Tools\Pagination\Paginator');
            $this->queryProperty = $reflection->getProperty('query');
            $this->queryProperty->setAccessible(true);
        }

        return $this->queryProperty->getValue($paginator);
    }
}
