<?php

namespace App\DataFixtures;

use App\Entity\Naudotojas;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class NaudotojasFixtures extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
     
    public function load(ObjectManager $manager)
    {
        $admin = new Naudotojas();
        $admin->setEmail('admin@gmail.com');
        $roles[] = 'ROLE_ADMIN';
        $admin->setRoles($roles);
        $admin->setPassword($this->passwordEncoder->encodePassword(
                         $admin,
                         '12345'
                     ));
        $manager->persist($admin);

        $klientas = new Naudotojas();
        $klientas->setEmail('klientas@gmail.com');
        $roles1[] = 'ROLE_KLIENTAS';
        $klientas->setRoles($roles1);
        $klientas->setPassword($this->passwordEncoder->encodePassword(
                         $klientas,
                         '12345'
                     ));
        $manager->persist($klientas);

        $instruktorius = new Naudotojas();
        $instruktorius->setEmail('instruktorius@gmail.com');
        $roles2[] = 'ROLE_INSTRUKTORIUS';
        $instruktorius->setRoles($roles2);
        $instruktorius->setPassword($this->passwordEncoder->encodePassword(
                         $instruktorius,
                         '12345'
                     ));
        $manager->persist($instruktorius);

        $manager->flush();
    }
}
