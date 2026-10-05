<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $status = new Status();
        $status->setName('New');
        $status->setTitle('New task');

        $manager->persist($status);
        $manager->flush();

        $manager->flush();
    }
}
