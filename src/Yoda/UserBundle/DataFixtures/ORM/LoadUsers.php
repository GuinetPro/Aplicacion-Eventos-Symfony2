<?php

namespace Yoda\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Yoda\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUsers implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('darth');
        //$user->setPassword($this->encodePassword($user, 'darthpass'));
        $user->setRoles(array('ROLE_USER'));
        $user->setPlainPassword('darthpass');
        $user->setEmail('darth@deathstar.com');
        $manager->persist($user);

        $admin = new User();
        $admin->setUsername('wayne');
        //$admin->setPassword($this->encodePassword($admin, 'waynepass'));
        $admin->setRoles(array('ROLE_ADMIN'));
        $admin->setEmail('wayne@deathstar.com');
        $admin->setPlainPassword('waynepass');
        $manager->persist($admin);

        // the queries aren't done until now
        $manager->flush();
    }



    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


     public function getOrder()
    {
        return 10;
    }

}
