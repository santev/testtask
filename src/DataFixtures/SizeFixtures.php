<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $code_arr = ['M', 'S', 'L', 'XS', 'XL', 'XXL', 'XXL'];

        $vol_arr = ['ml', 'L', 'pint', 'quart', 'gal'];
        $num_arr = ['0,1', '0,33', '0,5', '0,75', '1', '1,5'];

        $jew_arr = ['mm', 'cm', 'ct', 'gr', 'gm'];


        for ($i = 0; $i < 10; $i++) {

            switch ($i) {
                case ($i % 2):
                    $size = new Size();
                    $size->setType('size');
                    $size->setValue($code_arr[array_rand($code_arr)]);
                    $size->setCategory($this->getReference('category_1'));
                    $manager->persist($size);
                    break;

                case ($i % 3):
                    $size2 = new Size();
                    $size2->setType($vol_arr[array_rand($vol_arr)]);
                    $size2->setValue($num_arr[array_rand($num_arr)]);
                    $size2->setCategory($this->getReference('category_2'));
                    $manager->persist($size2);
                    break;

                case ($i % 5):
                    $size3 = new Size();
                    $size3->setType($jew_arr[array_rand($jew_arr)]);
                    $size3->setValue($i);
                    $size3->setCategory($this->getReference('category_3'));
                    $manager->persist($size3);
                    break;
            }
        }

        $manager->flush();

        $this->addReference('size_1', $size);
        $this->addReference('size_2', $size2);
        $this->addReference('size_3', $size3);
    }
}
