<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setUsername('admin')
              ->setEmail('admin@admin.fr')
              ->setEnabled('1')
              ->setRoles(array('ROLE_ADMIN'));
        $password = $this->encoder->encodePassword($admin, 'admin');
        $admin->setPassword($password);
        $manager->persist($admin);

        $user = new User();
        $user->setUsername('user')
             ->setEnabled('1')
             ->setEmail('user@user.fr');
        $password = $this->encoder->encodePassword($user, 'user');
        $user->setPassword($password);
        $manager->persist($user);

        $jj = new User();
        $jj->setUsername('jj')
             ->setEnabled('1')
             ->setEmail('jj@jj.fr')
             ->setRoles(array('ROLE_ADMIN'));
        $password = $this->encoder->encodePassword($jj, 'jjtest');
        $jj->setPassword($password);
        $manager->persist($jj);

        $riu = new User();
        $riu->setUsername('riu')
             ->setEnabled('1')
             ->setEmail('riu@riu.fr')
             ->setRoles(array('ROLE_ADMIN'));
        $password = $this->encoder->encodePassword($riu, 'riutest');
        $riu->setPassword($password);
        $manager->persist($riu);

        $antoine = new User();
        $antoine->setUsername('antoine')
             ->setEnabled('1')
             ->setEmail('antoine@antoine.fr')
             ->setRoles(array('ROLE_ADMIN'));
        $password = $this->encoder->encodePassword($antoine, 'antoinetest');
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
