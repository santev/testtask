<?php

namespace App\DataFixtures;

use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ItemFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create 20 products!
        for ($i = 0; $i < 30; $i++) {
            $item = new Item();
            $item->setName('Prod_' . (mt_rand()));
            $item->setCategory($this->getReference('category_'.mt_rand(1,3)));
            $manager->persist($item);
        }

        $manager->flush();

        $this->addReference('item_1', $item);
    }
}
 