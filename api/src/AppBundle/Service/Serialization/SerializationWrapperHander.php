<?php

namespace AppBundle\Service\Serialization;

use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\SerializationContext;
use \JMS\DiExtraBundle\Annotation as DI;

/**
 * Class SerializationWrapperHander
 * @package AppBundle\Service\Serialization
 *
 * @DI\Service("system.serializationwrapperhander")
 * @DI\Tag("jms_serializer.handler", attributes = {"direction" = "serialization", "format"="json", "type"="AppBundle\Service\Serialization\SerializationWrapper", "method"="handleWrapperSerialization"})
 */
class SerializationWrapperHander
{
    public function handleWrapperSerialization(
        JsonSerializationVisitor $visitor,
        SerializationWrapper $wrapper,
        array $type,
        SerializationContext $context
    ) {
        $subcontext = SerializationContext::create();

        $groups = $context->attributes->get('groups')->getOrElse(array('Default'));
        $subcontext->setGroups(array_merge($groups, $wrapper->additionalGroups));
        $subcontext->initialize(
            $context->getFormat(),
            $context->getVisitor(),
            $context->getNavigator(),
            $context->getMetadataFactory()
        );
        $subcontext->setSerializeNull($context->shouldSerializeNull());
        $subcontext->getVisitingSet()->addAll($context->getVisitingSet());

        /*
        if (is_array($wrapper->value)) {
            return $visitor->visitArray($wrapper->value, $type, $subcontext);
        }
        */
        $valueTypeName = gettype($wrapper->value);
        if ($valueTypeName === 'object') {
            $valueTypeName = get_class($wrapper->value);
        }
        $valueType = array('name' => $valueTypeName, 'params' => array());

        return $visitor->getNavigator()->accept($wrapper->value, $valueType, $subcontext);
    }
}
