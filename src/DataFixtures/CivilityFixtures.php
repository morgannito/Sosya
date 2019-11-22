<?php

namespace App\DataFixtures;

use App\Entity\Civility;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CivilityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $homme = $this->getReference('homme');
        $femme = $this->getReference('femme');

        $adminCVT = new Civility();
        $admin = $this->getReference('admin');
        $dateNow = date('2019-01-22');
        $adminCVT->setName('admin')
                 ->setDescription('I\'m the creator')
                 ->setFirstName('admin')
                 ->setBirth(\DateTime::createFromFormat('Y-m-d', $dateNow))
                 ->setUser($admin)
                 ->setSexe($homme);
        $manager->persist($adminCVT);

        $userCVT = new Civility();
        $user = $this->getReference('user');
        $userCVT->setName('user')
                ->setDescription('I\'m a test')
                ->setFirstName('user')
                ->setBirth(\DateTime::createFromFormat('Y-m-d', $dateNow))
                ->setUser($user)
                ->setSexe($femme);
        $manager->persist($userCVT);

        $jjCVT = new Civility();
        $jj = $this->getReference('jj');
        $jjCVT->setName('Double J')
                ->setDescription('I\'m a test')
                ->setFirstName('Acens')
                ->setBirth(\DateTime::createFromFormat('Y-m-d', $dateNow))
                ->setUser($jj)
                ->setSexe($homme);
        $manager->persist($jjCVT);

        $riuCVT = new Civility();
        $riu = $this->getReference('riu');
        $riuCVT->setName('Morgan')
                ->setDescription('I\'m a test')
                ->setFirstName('Riu')
                ->setBirth(\DateTime::createFromFormat('Y-m-d', $dateNow))
                ->setUser($riu)
                ->setSexe($homme);
        $manager->persist($riuCVT);

        $antoineCVT = new Civility();
        $antoine = $this->getReference('antoine');
        $antoineCVT->setName('Antoine')
                ->setDescription('I\'m a test')
                ->setFirstName('Jeannot')
                ->setBirth(\DateTime::createFromFormat('Y-m-d', $dateNow))
                ->setUser($antoine)
                ->setSexe($homme);
        $manager->persist($antoineCVT);

        $manager->flush();
    }

    // Doit charger le(s) fichier(s) avant celui ci, pour avoir les references
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            SexeFixtures::class,
        );
    }
}
