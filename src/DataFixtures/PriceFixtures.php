<?php

namespace App\DataFixtures;

use App\Entity\Price;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PriceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {


            $price = new Price();
            $price->setValue(mt_rand(0, 100) . '.00');
            $price->setCurrency($this->getReference('currency_1'));
            $price->setItem($this->getReference('item_1'));
            //$price->setSize($this->getReference('size_1'));
            $manager->persist($price);

            $price2 = new Price();
            $price2->setValue(mt_rand(0, 100) . '.00');
            $price2->setCurrency($this->getReference('currency_2'));
            $price2->setItem($this->getReference('item_1'));
            //$price2->setSize($this->getReference('size_1'));
            $manager->persist($price2);

            $price3 = new Price();
            $price3->setValue(mt_rand(0, 100) . '.00');
            $price3->setCurrency($this->getReference('currency_3'));
            $price3->setItem($this->getReference('item_1'));
            //$price3->setSize($this->getReference('size_1'));
            $manager->persist($price3);

        $manager->flush();

        $this->addReference('price_1', $price);
        $this->addReference('price_2', $price2);
        $this->addReference('price_3', $price3);
    }
}
