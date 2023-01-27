<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 30; $i++) {

            $size = new Size();

            switch (mt_rand(0, 2)) {
                case '0':
                    $code_arr = ['M', 'S', 'L', 'XS', 'XL', 'XXL', 'XXL'];
                    $size = new Size();
                    $size->setType('size');
                    $size->setValue($code_arr[array_rand($code_arr)]);
                    $manager->persist($size);
                    break;
                case '1':
                    $vol_arr = ['ml', 'L', 'pint', 'quart', 'gal'];
                    $num_arr = ['0,1', '0,33', '0,5', '0,75', '1', '1,5'];
                    $size->setType($vol_arr[array_rand($vol_arr)]);
                    $size->setValue($num_arr[array_rand($num_arr)]);
                    $manager->persist($size);
                    break;
                case '2':
                    $jew_arr = ['mm', 'cm', 'ct', 'qt', 'gr', 'gm'];
                    $size = new Size();
                    $size->setType($jew_arr[array_rand($jew_arr)]);
                    $size->setValue($i);
                    $manager->persist($size);
                    break;
                default:
                    # code...
                    break;
            }
        }

        $manager->flush();
    }
}
