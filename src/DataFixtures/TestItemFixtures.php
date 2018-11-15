<?php

namespace App\DataFixtures;

use App\Entity\TestItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TestItemFixtures extends Fixture{

  public function load(ObjectManager $manager)
  {
    $testItems = [
        [
            'species' => 'animal',
            'size' => 'large',
            'sex' => 'male',
            'price' => 500,
        ],
        [
            'species' => 'notAnimal',
            'size' => 'medium',
            'sex' => 'female',
            'price' => 200,
        ],

    ];

    foreach ($testItems as $item) {
      $testItem = new TestItem();
      $testItem->setName($item['name']);
      $testItem->setType($item['type']);
      $testItem->setSize($item['size']);
      $testItem->setPrice($item['price']);
      $manager->persist($testItem);
    }

    $manager->flush();
  }

}
