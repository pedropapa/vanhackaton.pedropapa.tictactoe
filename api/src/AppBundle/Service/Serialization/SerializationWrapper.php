<?php

namespace Core\SystemBundle\Services\Serialization;

use Core\SystemBundle\Services\SerializationUtil;

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
