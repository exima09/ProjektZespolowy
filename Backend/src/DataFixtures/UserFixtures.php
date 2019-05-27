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

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            ["admin", "admin", "admin", "admin", ["ROLE_ADMIN","ROLE_WARDEN", "ROLE_EXECUTIONER", "ROLE_SOCIAL", "ROLE_MEDICAL", "ROLE_PRISON_GUARD", "ROLE_MANAGER", "ROLE_USER"]],
            ["admin1", "admin1", "admin1", "admin1", ["ROLE_ADMIN","ROLE_WARDEN", "ROLE_EXECUTIONER", "ROLE_SOCIAL", "ROLE_MEDICAL", "ROLE_PRISON_GUARD", "ROLE_MANAGER", "ROLE_USER"]],
            ["admin2", "admin2", "admin2", "admin2", ["ROLE_ADMIN","ROLE_WARDEN", "ROLE_EXECUTIONER", "ROLE_SOCIAL", "ROLE_MEDICAL", "ROLE_PRISON_GUARD", "ROLE_MANAGER", "ROLE_USER"]],
            ["admin3", "admin3", "admin3", "admin3", ["ROLE_ADMIN","ROLE_WARDEN", "ROLE_EXECUTIONER", "ROLE_SOCIAL", "ROLE_MEDICAL", "ROLE_PRISON_GUARD", "ROLE_MANAGER", "ROLE_USER"]],

            ["guard", "guard", "guard", "guard", ["ROLE_PRISON_GUARD", "ROLE_USER"]],
            ["guard1", "guard1", "guard1", "guard1", ["ROLE_PRISON_GUARD", "ROLE_USER"]],
            ["guard2", "guard2", "guard2", "guard2", ["ROLE_PRISON_GUARD", "ROLE_USER"]],
            ["guard3", "guard3", "guard3", "guard3", ["ROLE_PRISON_GUARD", "ROLE_USER"]],

            ["social", "social", "social", "social", ["ROLE_SOCIAL", "ROLE_USER"]],
            ["social1", "social1", "social1", "social1", ["ROLE_SOCIAL", "ROLE_USER"]],
            ["social2", "social2", "social2", "social2", ["ROLE_SOCIAL", "ROLE_USER"]],
            ["social3", "social3", "social3", "social3", ["ROLE_SOCIAL", "ROLE_USER"]],

            ["medical", "medical", "medical", "medical", ["ROLE_MEDICAL", "ROLE_USER"]],
            ["medical1", "medical1", "medical1", "medical1", ["ROLE_MEDICAL", "ROLE_USER"]],
            ["medical2", "medical2", "medical2", "medical2", ["ROLE_MEDICAL", "ROLE_USER"]],
            ["medical3", "medical3", "medical3", "medical3", ["ROLE_MEDICAL", "ROLE_USER"]],

            ["executioner", "executioner", "executioner", "executioner", ["ROLE_EXECUTIONER", "ROLE_PRISON_GUARD", "ROLE_USER"]],
            ["executioner1", "executioner1", "executioner1", "executioner1", ["ROLE_EXECUTIONER", "ROLE_PRISON_GUARD", "ROLE_USER"]],
            ["executioner2", "executioner2", "executioner2", "executioner2", ["ROLE_EXECUTIONER", "ROLE_PRISON_GUARD", "ROLE_USER"]],
            ["executioner3", "executioner3", "executioner3", "executioner3", ["ROLE_EXECUTIONER", "ROLE_PRISON_GUARD", "ROLE_USER"]],

            ["manager", "manager", "manager", "manager", ["ROLE_MANAGER", "ROLE_USER"]],
            ["manager1", "manager1", "manager1", "manager1", ["ROLE_MANAGER", "ROLE_USER"]],
            ["manager2", "manager2", "manager2", "manager2", ["ROLE_MANAGER", "ROLE_USER"]],
            ["manager3", "manager3", "manager3", "manager3", ["ROLE_MANAGER", "ROLE_USER"]],

            ["warden", "warden", "warden", "warden", ["ROLE_WARDEN", "ROLE_EXECUTIONER", "ROLE_SOCIAL", "ROLE_MEDICAL", "ROLE_PRISON_GUARD", "ROLE_MANAGER", "ROLE_USER"]],
            ["warden1", "warden1", "warden1", "warden1", ["ROLE_WARDEN", "ROLE_EXECUTIONER", "ROLE_SOCIAL", "ROLE_MEDICAL", "ROLE_PRISON_GUARD", "ROLE_MANAGER", "ROLE_USER"]],

            ["user", "user", "user", "user", ["ROLE_USER"]],
            ["user1", "user1", "user1", "user1", ["ROLE_USER"]],
            ["user2", "user2", "user2", "user2", ["ROLE_USER"]],
            ["user3", "user3", "user3", "user3", ["ROLE_USER"]],

        ];


        foreach ($data as $key => $u) {
            $user = new User();
            $user->setUsername($u[0]);
            $user->setFirstName($u[1]);
            $user->setLastName($u[2]);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $u[3]
            ));
            $user->setRoles($u[4]);
            $this->addReference("user".$key ,$user);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
