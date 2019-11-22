<?php

namespace App\DataFixtures;

use App\Entity\DataUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class DataUserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $adminDT = new DataUser;
        $admin = $this->getReference('admin');
        $adminDT->setUser($admin)
                ->setLink("assets/images/resources/pf-img4.jpg")
                ->setBgLink("assets/images/resources/cover-img.jpg")
                ->setFacebook("fake")
                ->setTwitter("fake")
                ->setInstagram("fake");
        $manager->persist($adminDT);

        $userDT = new DataUser;
        $user = $this->getReference('user');
        $userDT->setUser($user)
                ->setLink("assets/images/resources/pf-img4.jpg")
                ->setBgLink("assets/images/resources/cover-img.jpg");
        $manager->persist($userDT);

        $jjDT = new DataUser;
        $jj = $this->getReference('jj');
        $jjDT->setUser($jj)
                ->setLink("assets/images/resources/pf-img4.jpg")
                ->setBgLink("assets/images/resources/cover-img.jpg");
        $manager->persist($jjDT);

        $riuDT = new DataUser;
        $riu = $this->getReference('riu');
        $riuDT->setUser($riu)
                ->setLink("assets/images/resources/pf-img4.jpg")
                ->setBgLink("assets/images/resources/cover-img.jpg");
        $manager->persist($riuDT);

        $antoineDT = new DataUser;
        $antoine = $this->getReference('antoine');
        $antoineDT->setUser($antoine)
                ->setLink("assets/images/resources/pf-img4.jpg")
                ->setBgLink("assets/images/resources/cover-img.jpg");
        $manager->persist($antoineDT);

        $manager->flush();

        // reference pour acceder avec une autre fixture
        $this->addReference('adminDT', $adminDT);
        $this->addReference('userDT', $userDT);
        $this->addReference('jjDT', $jjDT);
        $this->addReference('riuDT', $riuDT);
        $this->addReference('antoineDT', $antoineDT);
    }

    // Doit charger le(s) fichier(s) avant celui ci, pour avoir les references
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
