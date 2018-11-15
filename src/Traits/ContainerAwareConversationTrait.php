<?php

namespace App\Traits;

use App\Kernel;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

trait ContainerAwareConversationTrait
{

    use ContainerAwareTrait;

    public function __sleep()
    {
        $this->setContainer(null);

        return parent::__sleep();
    }

    public function __wakeup()
    {
        $this->initContainer();
    }

    private function initContainer()
    {
        $env = $_SERVER['APP_ENV'] ?? 'dev';
        $debug = (bool)($_SERVER['APP_DEBUG'] ?? ('prod' !== $env));
        $kernel = new Kernel($env, $debug);
        $kernel->boot();
        $this->setContainer($kernel->getContainer());
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        if ($this->container === null) {
            $this->initContainer();
        }

        return $this->container;
    }
}