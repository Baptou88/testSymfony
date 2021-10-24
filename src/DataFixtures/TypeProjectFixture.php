<?php


namespace App\DataFixtures;


use App\Entity\TypeProjet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class TypeProjectFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $typeNeuf = new TypeProjet();
        $typeNeuf->setName("Neuf");
        $typeNeuf->setIsVisible(true);
        $manager->persist($typeNeuf);
        $manager->flush();


        $this->addReference(TypeProjet::class . '_' . '0', $typeNeuf);

        $typeModif = new TypeProjet();
        $typeModif->setName("Modif");
        $typeModif->setIsVisible(true);
        $manager->persist($typeModif);
        $manager->flush();


        $this->addReference(TypeProjet::class . '_' . '1', $typeModif);
    }
}