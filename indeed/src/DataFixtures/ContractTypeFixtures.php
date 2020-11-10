<?php

namespace App\DataFixtures;

use App\Entity\ContractType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContractTypeFixtures extends Fixture
{
    const TYPES = [
        'type1' => [
            'name' => "temps plains"
        ],
        'type2' => [
            'name' => "temps partiel"
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::TYPES as $ref => $value) {
            $contractType = new ContractType();
            $contractType->setName($value["name"]);

            $this->addReference($ref, $contractType);

            $manager->persist($contractType);
        }

        $manager->flush();
    }
}
