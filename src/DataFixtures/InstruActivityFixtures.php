<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class InstruActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // instrument de musique
        $instrument = $this->getReference('instrument');

        $instrument1 = new Activity();
        $instrument1->setCategory($instrument)
            ->setName('Instruments à cordes')
            ->setImg('assets/images/activity/instrument/cordesres.png');
        $manager->persist($instrument1);

        $instrument2 = new Activity();
        $instrument2->setCategory($instrument)
            ->setName('Instruments à vents')
            ->setImg('assets/images/activity/instrument/ventres.png');
        $manager->persist($instrument2);

        $instrument3= new Activity();
        $instrument3->setCategory($instrument)
            ->setName('Instruments à percusion')
            ->setImg('assets/images/activity/instrument/percussionres.png');
        $manager->persist($instrument3);

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
