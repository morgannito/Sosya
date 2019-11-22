<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class JeuActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // jeux
        $jeux = $this->getReference('jeux');

        $jeux1 = new Activity();
        $jeux1->setCategory($jeux)
            ->setName('Karaoké')
            ->setImg('assets/images/activity/jeux/karaokeres.png');
        $manager->persist($jeux1);
        
        $jeux2 = new Activity();
        $jeux2->setCategory($jeux)
            ->setName('Escape game')
            ->setImg('assets/images/activity/jeux/escapegameres.png');
        $manager->persist($jeux2);
        
        $jeux3 = new Activity();
        $jeux3->setCategory($jeux)
            ->setName('Jeu de société')
            ->setImg('assets/images/activity/jeux/societeres.png');
        $manager->persist($jeux3);
        
        $jeux4 = new Activity();
        $jeux4->setCategory($jeux)
            ->setName('Bar de jeu')
            ->setImg('assets/images/activity/jeux/barjeures.png');
        $manager->persist($jeux4);
        
        $jeux5 = new Activity();
        $jeux5->setCategory($jeux)
            ->setName('Jeu de rôles')
            ->setImg('assets/images/activity/jeux/jdrres.png');
        $manager->persist($jeux5);

        $jeux6 = new Activity();
        $jeux6->setCategory($jeux)
            ->setName('Jeu old school')
            ->setImg('assets/images/activity/jeux/jeusoireres.png');
        $manager->persist($jeux6);

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
