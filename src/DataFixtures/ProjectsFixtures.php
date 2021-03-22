<?php

namespace App\DataFixtures;

use App\Entity\Projects;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProjectsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 100; $i++) { 
            $Project = new Projects;
            $Project
                ->setCode($faker->date($format = 'ny', $max = 'now') . "/". $faker->randomLetter() )
                ->setDateEntree($faker->dateTime($max = 'now', $timezone = null))
                ->setDateDelai($faker->dateTime($max = 'now', $timezone = null))
                ->setDescription($faker->words(3,true))
                ->settype($faker->numberBetween(1,3))
                ;
            $manager->persist($Project);
            
        }
        $manager->flush();
        // $product = new Product();
        // $manager->persist($product);

        
    }
}
