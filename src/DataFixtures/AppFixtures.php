<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');

    }

    public function load(ObjectManager $manager): void
    {
        //Users
        $users = [];

        $admin = new User();
        $admin->setFullName('Administrateur du Zoo Arcadia')
            ->setPseudo('José')
            ->setEmail('test@mail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPlainPassword('YYJU1pY5');

        $users[] = $admin;
        $manager->persist($admin);

        //Users
        $users = [];

        $user1 = new User();
        $user1->setFullName('Vétérinaire du Zoo Arcadia')
            ->setPseudo('Marc')
            ->setEmail('veto@mail.com')
            ->setRoles(['ROLE_USER1'])
            ->setPlainPassword('d5A8koVM');

        $users[] = $user1;
        $manager->persist($user1);

        //Users
        $users = [];

        $user2 = new User();
        $user2->setFullName('Employé du Zoo Arcadia')
            ->setPseudo('Caroline')
            ->setEmail('employe@mail.com')
            ->setRoles(['ROLE_USER2'])
            ->setPlainPassword('ZqelCOJD');

        $users[] = $user2;
        $manager->persist($user2);


        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setFullName($this->faker->name())
                ->setPseudo(mt_rand(0, 1) == 1 ? $this->faker->firstName() : null)
                ->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password');

            $manager->persist($user);
        }
    //contact test
    for ($i=0; $i < 5; $i++) {
        $contact = new Contact();
        $contact->setFullName($this->faker->name())
            ->setEmail($this->faker->email())
            ->setSubject('Demande d\'informations')
            ->setMessage($this->faker->text());

        $manager->persist($contact);
    }

        $manager->flush();
}
}

