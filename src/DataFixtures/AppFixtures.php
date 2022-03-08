<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->email = "test@test.com";
        // test1234
        $user->password = '$2y$13$NLuq50zm1ma1e6HjiVM9UuYwIQEZgWZnPZIiNUuzu6Xrl9xthv1KK';
        $manager->persist($user);

        $manager->flush();
    }
}
