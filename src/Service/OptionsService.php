<?php

namespace App\Service;

use App\Entity\TestItem;
use Doctrine\ORM\EntityManagerInterface;

class OptionsService
{

    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @return TestItem[]|array
     */
    public function getTestItems()
    {
        $testItem1 = new TestItem();

        $testItem1
            ->setId(1)
            ->setSpecies('Lion');

        $testItem2 = new TestItem();

        $testItem2
            ->setId(2)
            ->setSpecies('Dog');

        return [
            $testItem1,
            $testItem2
        ];

        return $this->em->getRepository(TestItem::class)->findAll();
    }
}