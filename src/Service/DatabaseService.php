<?php
/**
 * Created by PhpStorm.
 * User: macbookair
 * Date: 2018-12-17
 * Time: 10:30
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


//    public function getAnimal (String $animalBreed, String $animalSpecies, String $animalGender)
//    {
//     $animal = $this->em->getRepository(Animal::class)->findBy(array('species' => $animalSpecies,
//         'breed' => $animalBreed, 'gender' => $animalGender));
//
//     return $animal;
//    }


    public function getAllDogs()
    {
        $query = $this->em->createQuery('SELECT u FROM App\Entity\Animal u WHERE u.id = 28');
        return $query->getResult();
    }
}