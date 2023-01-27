<?php

namespace App\DataFixtures;

use App\Entity\Currency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CurrencyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $Currency = new Currency();
        $Currency->setName('EUR');
        $manager->persist($Currency);

        $Currency2 = new Currency();
        $Currency2->setName('USD');
        $manager->persist($Currency2);

        $Currency3 = new Currency();
        $Currency3->setName('GBP');
        $manager->persist($Currency3);

        $manager->flush();
    }
}
