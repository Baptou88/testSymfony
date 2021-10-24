<?php

namespace App\DataFixtures;

use App\Entity\Clients;
use App\Entity\Projects;
use App\Entity\TypeProjet;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class ProjectsFixtures extends BaseFixture implements DependentFixtureInterface
{
    private $referencesIndex = [];


    public function getDependencies(): array
    {
        return [
            ClientsFixture::class,
            TypeProjectFixture::class
        ];
    }


    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Projects::class, 100, function(Projects $project) {
            //$project->setContent(
            //    $this->faker->boolean ? $this->faker->paragraph : $this->faker->sentences(2, true)
            //);
            //$project->setAuthorName($this->faker->name);
            //$project->setCreatedAt($this->faker->dateTimeBetween('-1 months', '-1 seconds'));
            //$project->setArticle($this->getRandomReference(Clients::class));

            $project
                ->setCode($this->faker->date($format = 'ny', $max = 'now') . "/". $this->faker->randomLetter() )
                ->setDateEntree($this->faker->dateTime($max = 'now', $timezone = null))
                ->setDateDelai($this->faker->dateTime($max = 'now', $timezone = null))
                ->setDescription($this->faker->words(3,true))
                ->setClients($this->getRandomReference(Clients::class))
                ->setTypeProjet($this->getRandomReference(TypeProjet::class));
        });
        $manager->flush();
    }
}
