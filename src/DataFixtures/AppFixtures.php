<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Restaurant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 10; $i++) {
           
            $restaurant = new Restaurant();

            $restaurant->setName($faker->name());
            $restaurant->setAddress($faker->address(255));
            $restaurant->setZip($faker->numberBetween(75000, 90000));
            $restaurant->setCity($faker->city());
            $restaurant->setEmail($faker->email());
            $restaurant->setDescription($faker->text(1000));
            $restaurant->setImg('https://images.prismic.io/zenchef/1643a849-1e34-472c-b25c-6f40596741af_restaurant-vide.png?auto=compress,format');
            $manager->persist($restaurant);
        }

        $manager->flush();
    }
}

