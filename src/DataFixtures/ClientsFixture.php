<?php


namespace App\DataFixtures;


use App\Entity\Clients;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Query\Expr\Base;
use Doctrine\Persistence\ObjectManager;

class ClientsFixture extends BaseFixture
{

//    public function load(ObjectManager $manager)
//    {
//        for ($i=0; $i<100; $i++){
//            $client = new Clients();
//            $client->setName("Cli$i");
//
//        }
//    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Clients::class,50,function(Clients $clients){
            $clients->setName($this->faker->name());

        });
        $manager->flush();
    }
}