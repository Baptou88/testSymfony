<?php


namespace App\DataFixtures;


use App\Entity\Employes;
use Doctrine\Persistence\ObjectManager;

class EmployesFixture extends \Doctrine\Bundle\FixturesBundle\Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        for ($i= 0; $i<20; $i++)
        {
            $employe = new Employes();
            $employe->setName("Name$i");
            $employe->setPrenom("Prenom$i");
            $employe->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($employe) ;
            $manager->flush();
        }
    }
}