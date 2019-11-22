<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $sport = new Category();
        $sport->setName('Sport')
            ->setImage('assets/images/categories/sportres.png');
        $manager->persist($sport);

        $culture = new Category();
        $culture->setName('Culture')
            ->setImage('assets/images/categories/cultureres.png');
        $manager->persist($culture);

        $art = new Category();
        $art->setName('Art')
            ->setImage('assets/images/categories/art.png');
        $manager->persist($art);

        $musique = new Category();
        $musique->setName('Musique')
            ->setImage('assets/images/categories/musicres.png');
        $manager->persist($musique);

        $jeuxVideos = new Category();
        $jeuxVideos->setName('Jeux Vidéos')
            ->setImage('assets/images/categories/jeuxres.png');
        $manager->persist($jeuxVideos);

        $film = new Category();
        $film->setName('Film')
            ->setImage('assets/images/categories/filmres.png');
        $manager->persist($film);

        $serie = new Category();
        $serie->setName('Serie')
            ->setImage('assets/images/categories/serieres.png');
        $manager->persist($serie);

        $animaux = new Category();
        $animaux->setName('Animaux')
            ->setImage('assets/images/categories/catres.png');
        $manager->persist($animaux);

        $instrument = new Category();
        $instrument->setName('Instruments')
            ->setImage('assets/images/categories/instrumentres.png');
        $manager->persist($instrument);

        $jeux = new Category();
        $jeux->setName('Jeux (société, de plein air, etc...)')
            ->setImage('assets/images/categories/societeres.png');
        $manager->persist($jeux);

        $this->addReference('sport', $sport);
        $this->addReference('culture', $culture);
        $this->addReference('art', $art);
        $this->addReference('musique', $musique);
        $this->addReference('jeuxVideos', $jeuxVideos);
        $this->addReference('film', $film);
        $this->addReference('serie', $serie);
        $this->addReference('instrument', $instrument);
        $this->addReference('jeux', $jeux);
        $this->addReference('animaux', $animaux);

        $manager->flush();
    }
}
