<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AnimauxActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // animaux
        $animaux = $this->getReference('animaux');

        $animaux1 = new Activity();
        $animaux1->setCategory($animaux)
            ->setName('chats')
            ->setImg('assets/images/activity/animaux/chatres.png');
        $manager->persist($animaux1);
        
        $animaux2 = new Activity();
        $animaux2->setCategory($animaux)
            ->setName('chiens')
            ->setImg('assets/images/activity/animaux/chienres.png');
        $manager->persist($animaux2);
        
        $animaux3 = new Activity();
        $animaux3->setCategory($animaux)
            ->setName('rongeurs')
            ->setImg('assets/images/activity/animaux/lapinres.png');
        $manager->persist($animaux3);

        $animaux4 = new Activity();
        $animaux4->setCategory($animaux)
            ->setName('oiseaux')
            ->setImg('assets/images/activity/animaux/oiseaures.png');
        $manager->persist($animaux4);

        $animaux5 = new Activity();
        $animaux5->setCategory($animaux)
            ->setName('reptiles')
            ->setImg('assets/images/activity/animaux/reptileres.png');
        $manager->persist($animaux5);
        
        $animaux6 = new Activity();
        $animaux6->setCategory($animaux)
            ->setName('Autres')
            ->setImg('assets/images/activity/animaux/iguaneres.png');
        $manager->persist($animaux6);

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
