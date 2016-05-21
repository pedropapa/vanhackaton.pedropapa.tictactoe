<?php
namespace AppBundle\Security\Authentication\Token;

use Core\GameBundle\Entity\Player;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class LoginToken extends AbstractToken
{
    public $created;
    public $digest;
    public $nonce;

    /** @var Player */
    private $player;

    public function __construct(Player $player, array $roles = array())
    {
        parent::__construct($roles);

        $this->setUser($player);

        // If the user has roles, consider it authenticated
        $this->setAuthenticated(count($roles) > 0);
    }

    public function getCredentials()
    {
        return $this->player->getDsName();
    }
}