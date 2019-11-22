<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MusicActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // musique (styles musicaux)
        $musi = $this->getReference('musique');

        $rap = new Activity();
        $rap->setName('Rap')
            ->setCategory($musi)
            ->setImg('assets/images/activity/musique/rapres.png');
        $manager->persist($rap);

        $hiphop = new Activity();
        $hiphop->setName('Hip-hop')
            ->setCategory($musi)
            ->setImg('assets/images/activity/musique/hiphopres.png');
        $manager->persist($hiphop);

        $classic = new Activity();
        $classic->setName('Jazz')
            ->setCategory($musi)
            ->setImg('assets/images/activity/musique/jazzres.jpg');
        $manager->persist($classic);

        $electro = new Activity();
        $electro->setName('Electro')
            ->setCategory($musi)
            ->setImg('assets/images/activity/musique/electrores.png');
        $manager->persist($electro);

        $rock = new Activity();
        $rock->setName('Rock')
            ->setCategory($musi)
            ->setImg('assets/images/activity/musique/rockres.png');
        $manager->persist($rock);

        $bs = new Activity();
        $bs->setName('Bande son')
            ->setCategory($musi)
            ->setImg('assets/images/activity/musique/soundtrackres.png');
        $manager->persist($bs);

        $variete = new Activity();
        $variete->setName('Variété')
            ->setCategory($musi)
            ->setImg('assets/images/activity/musique/varieteres.png');
        $manager->persist($variete);

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
