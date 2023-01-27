<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = new Category();
        $category->setName('Clothes');
        $category->setPriceBySize(null);
        $manager->persist($category);

        $category2 = new Category();
        $category2->setName('Parfum');
        $category2->setPriceBySize(true);
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Jewelry');
        $category3->setPriceBySize(true);
        $manager->persist($category3);

        $manager->flush();

        $this->addReference('category_1', $category);
        $this->addReference('category_2', $category2);
        $this->addReference('category_3', $category3);
    }
}
