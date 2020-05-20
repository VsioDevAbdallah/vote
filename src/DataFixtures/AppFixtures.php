<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    // ...
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("abdallahtra10@gmail.com");
        $user->setFirstname("Traore");
        $user->setLastname("Abdallah");
        $user->setPower(10);
        $password = $this->encoder->encodePassword($user, '123');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
