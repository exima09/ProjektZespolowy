<?php

namespace App\DataFixtures;

    use App\Entity\User;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\Persistence\ObjectManager;
    use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername("admin");
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));
        $user->setRoles(["ROLE_ADMIN","ROLE_PRISON_GUARD", "ROLE_USER"]);
        $manager->persist($user);

        $user1 = new User();
        $user1->setUsername("test");
        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            'test'
        ));
        $user1->setRoles(["ROLE_USER"]);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername("guard");
        $user2->setPassword($this->passwordEncoder->encodePassword(
            $user2,
            'guard'
        ));
        $user2->setRoles(["ROLE_PRISON_GUARD", "ROLE_USER"]);
        $manager->persist($user2);
        $manager->flush();
    }
}
