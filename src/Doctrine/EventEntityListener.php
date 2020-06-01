<?php


namespace App\Doctrine;


use App\Entity\Events;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class EventEntityListener
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function prePersist(Events $events)
    {
        if($events->getTitle()) return ;
        if ($this->tokenStorage->getToken()->getTitle()){
            $events->setTitle($this->tokenStorage->getToken()->getTitle());
        }
    }
}