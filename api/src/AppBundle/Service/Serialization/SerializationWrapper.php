<?php

namespace AppBundle\Service\Serialization;

/**
 * Classe de apoio usada pelo {@link SerializationUtil} para adicionar grupos a
 * elementos em um processo de serialização.
 */
class SerializationWrapper
{
    /** @var array */
    public $additionalGroups;
    /** @var mixed */
    public $value;

    public function __construct(array $additionalGroups, $value)
    {
        $this->additionalGroups = $additionalGroups;
        $this->value = $value;
    }
}
