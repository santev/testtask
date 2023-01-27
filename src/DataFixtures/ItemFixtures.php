<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ItemFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create 20 products!
        for ($i = 0; $i < 20; $i++) {
            $item = new Item();
            $item->setName('Prod_' . (mt_rand()));
            $manager->persist($item);
        }

        $manager->flush();
    }
}
