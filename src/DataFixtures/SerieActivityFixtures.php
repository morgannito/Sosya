<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SerieActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Serie 
        $serie = $this->getReference('serie');

        $serie1 = new Activity();
        $serie1->setCategory($serie)
            ->setName('Drame')
            ->setImg('assets/images/activity/serie/drameres.png');
        $manager->persist($serie1);

        $serie2 = new Activity();
        $serie2->setCategory($serie)
            ->setName('Action')
            ->setImg('assets/images/activity/serie/actionres.png');
        $manager->persist($serie2);

        $serie3 = new Activity();
        $serie3->setCategory($serie)
            ->setName('Aventure')
            ->setImg('assets/images/activity/serie/aventureres.png');
        $manager->persist($serie3);

        $serie6 = new Activity();
        $serie6->setCategory($serie)
            ->setName('Comédie')
            ->setImg('assets/images/activity/serie/comedieres.png');
        $manager->persist($serie6);

        $serie9 = new Activity();
        $serie9->setCategory($serie)
            ->setName('Espionnage')
            ->setImg('assets/images/activity/serie/espionnageres.png');
        $manager->persist($serie9);

        $serie11 = new Activity();
        $serie11->setCategory($serie)
            ->setName('Fantastique')
            ->setImg('assets/images/activity/serie/fantastiqueres.png');
        $manager->persist($serie11);

        $serie15 = new Activity();
        $serie15->setCategory($serie)
            ->setName('Horreur')
            ->setImg('assets/images/activity/serie/horreurres.png');
        $manager->persist($serie15);

        $serie17 = new Activity();
        $serie17->setCategory($serie)
            ->setName('Romance')
            ->setImg('assets/images/activity/serie/romanceres.png');
        $manager->persist($serie17);

        $serie18 = new Activity();
        $serie18->setCategory($serie)
            ->setName('Science-Fiction')
            ->setImg('assets/images/activity/serie/scienfictionres.png');
        $manager->persist($serie18);

        $serie20 = new Activity();
        $serie20->setCategory($serie)
            ->setName('Survival')
            ->setImg('assets/images/activity/serie/survivalres.png');
        $manager->persist($serie20);

        $serie22 = new Activity();
        $serie22->setCategory($serie)
            ->setName('Historique')
            ->setImg('assets/images/activity/serie/historiqueres.png');
        $manager->persist($serie22);



        
        $serie24 = new Activity();
        $serie24->setCategory($serie)
            ->setName('Jeunesse')
            ->setImg('assets/images/activity/serie/jeunesseres.png');
        $manager->persist($serie24);
 


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
