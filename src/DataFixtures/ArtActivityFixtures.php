<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArtActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {   
        // art (les 9 arts majeurs)
        $art = $this->getReference('art');

        $architecture  = new Activity();
        $architecture ->setName('architecture ')
            ->setImg('assets/images/activity/art/architectureres.png')
            ->setCategory($art);
        $manager->persist($architecture );

        $sculpture = new Activity();;
        $sculpture->setName('sculpture')
            ->setImg('assets/images/activity/art/sculpteurres.png')
            ->setCategory($art);
        $manager->persist($sculpture);

        $artsVisuels = new Activity();
        $artsVisuels->setName('arts visuels')
            ->setImg('assets/images/activity/art/visuelres.png')
            ->setCategory($art);
        $manager->persist($artsVisuels);

        
        $artsnumerique = new Activity();
        $artsnumerique->setName('arts numérique')
            ->setImg('assets/images/activity/art/numeriqueres.png')
            ->setCategory($art);
        $manager->persist($artsnumerique);

        // $musique = new Activity();
        // $musique->setName('musique')
        //     ->setImg('assets/images/activity/art/classicres.jpg')
        //     ->setCategory($art);
        // $manager->persist($musique);
        
        $littérature = new Activity();
        $littérature->setName('littérature')
            ->setImg('assets/images/activity/art/litteratureres.png')
            ->setCategory($art);
        $manager->persist($littérature);

        $artsDeLaScène = new Activity();
        $artsDeLaScène->setName('arts de la scène')
            ->setImg('assets/images/activity/art/theatreres.png')
            ->setCategory($art);
        $manager->persist($artsDeLaScène);

        // $cinema = new Activity();
        // $cinema->setName('Cinéma')
        //     ->setImg('assets/images/activity/art/cinemares.png')
        //     ->setCategory($art);
        // $manager->persist($cinema);

        $lesArtsMediatiques = new Activity();
        $lesArtsMediatiques->setName('Les arts médiatiques')
            ->setImg('assets/images/activity/art/journalismeres.jpg')
            ->setCategory($art);
        $manager->persist($lesArtsMediatiques);

        $bd = new Activity();
        $bd->setName('La bande-dessinée')
            ->setImg('assets/images/activity/art/bdres.png')
            ->setCategory($art);
        $manager->persist($bd);

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
