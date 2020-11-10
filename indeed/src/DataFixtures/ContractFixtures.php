<?php

namespace App\DataFixtures;

use App\Entity\Contract;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContractFixtures extends Fixture
{
    const CONTRACTS = [
        'contract1' => [
            'name' => "CDD"
        ],
        'contract2' => [
            'name' => "CDI"
        ],
        'contract3' => [
            'name' => "free"
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CONTRACTS as $ref => $value) {
            $contract = new Contract();
            $contract->setName($value["name"]);

            $this->addReference($ref, $contract);

            $manager->persist($contract);
        }

        $manager->flush();
    }
}
