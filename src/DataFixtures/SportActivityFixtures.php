<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SportActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Activités sportives
        $sport = $this->getReference('sport');
        
        $hiver = new Activity();
        $hiver->setName('Sports d\'hiver')
            ->setImg('assets/images/activity/sport/hiverres.png')
            ->setCategory($sport);
        $manager->persist($hiver);

        $equipe = new Activity();
        $equipe->setName('Sports d\'équipe')
            ->setImg('assets/images/activity/sport/equiperes.png')
            ->setCategory($sport);
        $manager->persist($equipe);

        $indi = new Activity();
        $indi->setName('Sports individuels')
            ->setImg('assets/images/activity/sport/individuelres.png')
            ->setCategory($sport);
        $manager->persist($indi);
        
        $aqua = new Activity();
        $aqua->setName('Sports aquatiques')
            ->setImg('assets/images/activity/sport/aquatiqueres.png')
            ->setCategory($sport);
        $manager->persist($aqua);

        $muscu = new Activity();
        $muscu->setName('Musculation')
            ->setImg('assets/images/activity/sport/muscures.png')
            ->setCategory($sport);
        $manager->persist($muscu);

        $sportete = new Activity();
        $sportete->setName('Sports d\'été')
            ->setImg('assets/images/activity/sport/eteres.png')
            ->setCategory($sport);
        $manager->persist($sportete);

        
        
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
