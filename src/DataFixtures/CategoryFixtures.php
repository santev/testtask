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
        $manager->persist($category);
        
        $category2 = new Category();
        $category2->setName('Parfum');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Jewelry');
        $manager->persist($category3);

        $manager->flush();
    }
}
