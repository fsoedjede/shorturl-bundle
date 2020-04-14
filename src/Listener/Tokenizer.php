<?php

namespace Fabstei\ShorturlBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Fabstei\ShorturlBundle\Entity\Url;
use Fabstei\ShorturlBundle\Service\Token;

class Tokenizer
{
    /**
     * @var Token
     */
    private $tokenizer;

    /**
     * Constructs a new instance of Tokenizer.
     *
     * @param Token $token
     */
    public function __construct(Token $token)
    {
        $this->tokenizer = $token;
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->addToken($args);
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->addToken($args);
    }

    public function addToken(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();

        if ($entity instanceof Url) {
            if (!$entity->getToken()) {
                $entity->setToken($this->tokenizer->encode($entity->getId()));
            }

            $em = $args->getEntityManager();
            $em->persist($entity);
            $em->flush();
        }
    }
}
