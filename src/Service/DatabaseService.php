<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Animal;

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

    public function getAllAnimals()
    {
        $query = $this->em->createQuery('SELECT f FROM App\Entity\Animal f GROUP BY f.species');
        return $query->getResult();
    }

    public function getBreeds(String $species)
    {
        $query = $this->em->createQuery('SELECT f FROM App\Entity\Animal f WHERE f.species = :givenSpecies GROUP BY f.breed')->setParameter('givenSpecies', $species);
        return $query->getResult();
    }
}