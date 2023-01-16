<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Customers;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        $user = new User();

        $password = $this->hasher->hashPassword($user, 'password');

        $user->setEmail('manbanh@free.fr')
            ->setPassword($password)
            ->setFirstName('Duc-Man')
            ->setLastName('Banh')
            ->setRoles(["ROLE_ADMIN"]);

        $manager->persist($user);

        for($i = 0; $i<20; $i++)
        {
            $clients = new Customers();

            $clients->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setAddress($faker->streetAddress())
                ->setZipCode($faker->postcode())
                ->setEmail($faker->email())
                ->setPhone($faker->phoneNumber())
                
            ;

            $manager->persist($clients);
        }

        $manager->flush();
    }
}
