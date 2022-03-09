<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class CategoryFixtures extends Fixture implements  OrderedFixtureInterface
{
    public static int $numberOfRecords;


    public static array $categories = [
        "Economies",
        "Politiques",
        "France",
        "International",
        "Société",
        "Présidentielles"
    ];

    public function __construct() {
        self::$numberOfRecords = count(self::$categories);
    }



    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < self::$numberOfRecords; $i++) {
            $category = new Category();
            $category->setCategoryName(self::$categories[$i]);
            $this->addReference("category". $i+1, $category);
            $manager->persist($category);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}