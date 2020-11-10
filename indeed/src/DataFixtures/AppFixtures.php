<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $offer = new Offer();

            $contractType = $faker->randomElement($array = array('CDD', 'CDI', 'FREE'));
            $contractEnd = null;

            if ($contractType != "CDI")
                $contractEnd = $faker->dateTimeBetween(new \DateTime(), '2022-01-01 00:00:00');


            $offer->setTitle($faker->sentence($nbWords = 2, $variableNBWords = true))
                ->setDescription($faker->sentence($nbWords = 20, $variableNBWords = true))
                ->setAdresse($faker->address())
                ->setPostalCode($faker->postcode())
                ->setCity($faker->city())
                ->setCreationDate(new \DateTime())
                ->setUpdateDate(new \DateTime())
                ->setContract($contractType)
                ->setContractEnd($contractEnd)
                ->setContractType($faker->randomElement($array = array('temps plains', 'temps partiel')));

            $manager->persist($offer);
        }

        $manager->flush();
    }
}
