<?php
/**
 * Created by PhpStorm.
 * User: macbookair
 * Date: 2018-12-12
 * Time: 09:46
 */

namespace App\DataFixtures;

use App\Entity\Pet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PetFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $pets = [
            [
                'species' => 'dog',
                'breed' => 'bulldog',
                'gender' => 'male',
                'price' => 500,
            ],
            [
                'species' => 'cat',
                'breed' => 'siberian',
                'gender' => 'male',
                'price' => 500,
            ],

        ];

        foreach ($pets as $item) {
            $pets = new Pet();
            $pets->setSpecies($item['species']);
            $pets->setBreed($item['breed']);
            $pets->setGender($item['gender']);
            $pets->setPrice($item['price']);
            $manager->persist($pets);
        }
        $manager->flush();
    }
}