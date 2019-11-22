<?php

namespace App\DataFixtures;

use App\Entity\Follow;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FollowFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // info du suiveur et du suivie
        // admin follow
        $admin = $this->getReference('admin');
        // data du suivi (1)
        $user = $this->getReference('user');
        // ajouter le follow
        $adminFollowUser = new Follow();
        $adminFollowUser->setFollower($admin)
                    ->setFollowing($user);
        $manager->persist($adminFollowUser);
        // ajouter la data
        // END 
        //
        // data du suivi (2)
        $jj = $this->getReference('jj');
        // ajouter le follow
        $adminFollowJj = new Follow();
        $adminFollowJj->setFollower($admin)
                    ->setFollowing($jj);
        $manager->persist($adminFollowJj);
        // END 

        // info du suiveur et du suivie
        // user follow
        $user = $this->getReference('user');
        // data du suivi (1)
        $admin = $this->getReference('admin');
        // ajouter le follow
        $userFollowAdmin = new Follow();
        $userFollowAdmin->setFollower($user)
                   ->setFollowing($admin);
        $manager->persist($userFollowAdmin);
        // END 

        // info du suiveur et du suivie
        // jj follow
        $jj = $this->getReference('jj');
        // data du suivi (1)
        $admin = $this->getReference('admin');
        // ajouter le follow
        $jjFollowAdmin = new Follow();
        $jjFollowAdmin->setFollower($jj)
                    ->setFollowing($admin);
        $manager->persist($jjFollowAdmin);
        // END 

        // info du suiveur et du suivie
        // riu follow
        $riu = $this->getReference('riu');
        // data du suivi (1)
        $admin = $this->getReference('admin');
        // ajouter le follow
        $riuFollowAdmin = new Follow();
        $riuFollowAdmin->setFollower($riu)
                    ->setFollowing($admin);
        $manager->persist($riuFollowAdmin);
        // END 

        // info du suiveur et du suivie
        // antoine follow
        $antoine = $this->getReference('antoine');
        // data du suivi (1)
        $admin = $this->getReference('admin');
        // ajouter le follow
        $antoineFollowAdmin = new Follow();
        $antoineFollowAdmin->setFollower($antoine)
                    ->setFollowing($admin);
        $manager->persist($antoineFollowAdmin);
        // END 

        $manager->flush();
    }

    // Doit charger le(s) fichier(s) avant celui ci, pour avoir les references
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
