<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // Création d’un utilisateur de type “auteur”
        $subscriber = new User();
        $subscriber->setEmail('maillard.adrien@gmail.com');
        $subscriber->setRoles(['ROLE_SUBSCRIBER']);
        $subscriber->setPassword($this->passwordEncoder->encodePassword(
            $subscriber,
            'drowssap!4'
        ));

        $manager->persist($subscriber);

        // Création d’un utilisateur de type “administrateur”
        $admin1 = new User();
        $admin1->setEmail('admin@monsite.com');
        $admin1->setRoles(['ROLE_ADMIN']);
        $admin1->setPassword($this->passwordEncoder->encodePassword(
            $admin1,
            'drowssap!4'
        ));

        $manager->persist($admin1);

        // Sauvegarde des 2 nouveaux utilisateurs :
        $manager->flush();
    }
}
