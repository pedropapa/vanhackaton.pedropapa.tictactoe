<?php

namespace AppBundle\Service\Serialization;

use JMS\DiExtraBundle\Annotation\Tag;
use JMS\Serializer\Context;
use JMS\Serializer\VisitorInterface;
use \JMS\DiExtraBundle\Annotation as DI;

/**
 * Serializa objetos stdClass como objetos simples JSON.
 * @DI\Service("system.stdclasshandler")
 * @Tag("jms_serializer.handler", attributes = {"direction" = "serialization", "format"="json", "type"="stdClass", "method"="serializeStdClass"})
 */
class StdClassHandler
{
    public function serializeStdClass(
        VisitorInterface $visitor,
        \stdClass $obj,
        array $type,
        Context $context
    ) {
        $array = (array)$obj;
        if ($array) {
            // se o objeto não estiver vazio, é muito mais simples convertê-lo
            // para array e usar as facilidades já prontas
            return $visitor->visitArray($array, $type, $context);
        }

        $metadata = $context->getMetadataFactory()->getMetadataForClass("stdClass");
        $visitor->startVisitingObject($metadata, $obj, $type, $context);
        return $visitor->endVisitingObject($metadata, $obj, $type, $context);
    }
}
