<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\ContractTypeFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [ContractTypeFixtures::class];
    }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $offer = new Offer();


            $contractType = $this->getReference("type" . rand(1, 2));

            $contract = $faker->randomElement($array = array('CDD', 'CDI', 'FREE'));
            $contractEnd = null;

            if ($contract != "CDI")
                $contractEnd = $faker->dateTimeBetween(new \DateTime(), '2022-01-01 00:00:00');


            $offer->setTitle($faker->sentence($nbWords = 2, $variableNBWords = true))
                ->setDescription($faker->sentence($nbWords = 20, $variableNBWords = true))
                ->setAdresse($faker->address())
                ->setPostalCode($faker->postcode())
                ->setCity($faker->city())
                ->setCreationDate(new \DateTime())
                ->setUpdateDate(new \DateTime())
                ->setContract($contract)
                ->setContractEnd($contractEnd)
                ->setContractType($contractType->getName());

            $manager->persist($offer);
        }

        $manager->flush();
    }
}
