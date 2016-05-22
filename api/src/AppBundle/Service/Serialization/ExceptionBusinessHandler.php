<?php

namespace Core\SystemBundle\Services\Serialization;

use abstraction\business\exception\ExceptionBusiness;
use JMS\Serializer\Context;
use JMS\Serializer\Metadata\PropertyMetadata;
use JMS\Serializer\VisitorInterface;
use \JMS\DiExtraBundle\Annotation as DI;

/**
 * Class ExceptionBusinessHandler
 * @package Core\SystemBundle\Services\Serialization
 *
 * @DI\Service("system.exceptionbusinesshandler")
 * @DI\Tag("jms_serializer.handler", attributes = {"direction" = "serialization", "format"="json", "type"="abstraction\business\exception\ExceptionBusiness", "method"="serialize"})
 */
class ExceptionBusinessHandler
{
    public function serialize(
        VisitorInterface $visitor,
        ExceptionBusiness $obj,
        array $type,
        Context $context
    ) {
        return $visitor->visitArray(
            array(
                'message' => $obj->getMessage(),
            ),
            $type,
            $context
        );
    }
}
