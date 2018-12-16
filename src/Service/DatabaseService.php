<?php
/**
 * Created by PhpStorm.
 * User: macbookair
 * Date: 2018-12-16
 * Time: 09:28
 */

namespace App\Service;

use App\Entity\Animal;
use App\Entity\Client;
use App\Entity\Orders;
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

    public function getDogBreeds()
    {
        $query = $this->em->createQuery('SELECT DISTINCT (breed) FROM App\Entity\Animal WHERE species = "Dog"');

        return $query->getResult();
    }

    public function getCatBreeds()
    {
        $query = $this->em->createQuery('SELECT DISTINCT (breed) FROM App\Entity\Animal WHERE species = "Cat"');

        return $query->getResult();
    }

}