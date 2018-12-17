<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class DatabaseService
{
    protected $em;

    /**
     * DatabaseService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getAllDogs()
    {
        $query = $this->em->createQuery('SELECT DISTINCT u FROM App\Entity\Animal u');
        return $query->getResult();
    }
}