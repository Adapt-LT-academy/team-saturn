<?php
/**
 * Created by PhpStorm.
 * User: macbookair
 * Date: 2018-12-12
 * Time: 09:46
 */

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AnimalFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $animals = [
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

        foreach ($animals as $item) {
            $animals = new Pet();
            $animals->setSpecies($item['species']);
            $animals->setBreed($item['breed']);
            $animals->setGender($item['gender']);
            $animals->setPrice($item['price']);
            $manager->persist($animals);
        }
        $manager->flush();
    }
}