<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setUsername('admin')
              ->setEmail('admin@admin.fr')
              ->setEnabled(true)
              ->setRoles(array('ROLE_ADMIN'));
        $password = $this->hasher->hashPassword($admin, 'admin');
        $admin->setPassword($password);
        $manager->persist($admin);

        $user = new User();
        $user->setUsername('user')
             ->setEnabled(true)
             ->setEmail('user@user.fr');
        $password = $this->hasher->hashPassword($user, 'user');
        $user->setPassword($password);
        $manager->persist($user);

        $jj = new User();
        $jj->setUsername('jj')
             ->setEnabled(true)
             ->setEmail('jj@jj.fr')
             ->setRoles(array('ROLE_ADMIN'));
        $password = $this->hasher->hashPassword($jj, 'jjtest');
        $jj->setPassword($password);
        $manager->persist($jj);

        $riu = new User();
        $riu->setUsername('riu')
             ->setEnabled(true)
             ->setEmail('riu@riu.fr')
             ->setRoles(array('ROLE_ADMIN'));
        $password = $this->hasher->hashPassword($riu, 'riutest');
        $riu->setPassword($password);
        $manager->persist($riu);

        $antoine = new User();
        $antoine->setUsername('antoine')
             ->setEnabled(true)
             ->setEmail('antoine@antoine.fr')
             ->setRoles(array('ROLE_ADMIN'));
        $password = $this->hasher->hashPassword($antoine, 'antoinetest');
        $antoine->setPassword($password);
        $manager->persist($antoine);

        $manager->flush();

        // reference pour acceder avec une autre fixture
        $this->addReference('admin', $admin);
        $this->addReference('user', $user);
        $this->addReference('jj', $jj);
        $this->addReference('riu', $riu);
        $this->addReference('antoine', $antoine);
    }
}
