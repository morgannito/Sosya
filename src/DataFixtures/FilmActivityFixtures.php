<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FilmActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //film
        $film = $this->getReference('film');

        $film1 = new Activity();
        $film1->setCategory($film)
            ->setName('Action')
            ->setImg('assets/images/activity/film/actionres.png');
        $manager->persist($film1);

        $film2 = new Activity();
        $film2->setCategory($film)
            ->setName('Aventure')
            ->setImg('assets/images/activity/film/aventureres.png');
        $manager->persist($film2);

        $film3 = new Activity();
        $film3->setCategory($film)
            ->setName('Biopic')
            ->setImg('assets/images/activity/film/biopicres.png');
        $manager->persist($film3);

        $film5 = new Activity();
        $film5->setCategory($film)
            ->setName('Comédie')
            ->setImg('assets/images/activity/film/comedieres.png');
        $manager->persist($film5);

        $film10 = new Activity();
        $film10->setCategory($film)
            ->setName('Fantastique')
            ->setImg('assets/images/activity/film/fantastiqueres.png');
        $manager->persist($film10);

        $film14 = new Activity();
        $film14->setCategory($film)
            ->setName('Horreur')
            ->setImg('assets/images/activity/film/horreurres.png');
        $manager->persist($film14);

        $film16 = new Activity();
        $film16->setCategory($film)
            ->setName('Romance')
            ->setImg('assets/images/activity/film/romanceres.png');
        $manager->persist($film16);

        $film19 = new Activity();
        $film19->setCategory($film)
            ->setName('Drame')
            ->setImg('assets/images/activity/film/drameres.png');
        $manager->persist($film19);


        $film22 = new Activity();
        $film22->setCategory($film)
            ->setName('Jeunesse')
            ->setImg('assets/images/activity/film/jeunesseres.png');
        $manager->persist($film22);
        $manager->flush();
    }

    
    // Doit charger le(s) fichier(s) avant celui ci, pour avoir les references
    public function getDependencies()
    {
        return array(
            CategoryFixtures::class,
        );
    }
}
