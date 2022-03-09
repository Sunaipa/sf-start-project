<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class ArticleFixtures extends Fixture implements OrderedFixtureInterface
{
    private Generator $faker;


    public function __construct(){
        $this->faker = Factory::create();
    }

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $NumberOfRecords = 200;
        for ($i=1; $i <= $NumberOfRecords; $i++){
            $this->getRandomArticle($manager);
        }
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @return void
     * @throws \Exception
     */
    public function getRandomArticle(ObjectManager $manager): void{
        $createdAt = $this->faker->dateTimeThisDecade();
        $updatedAt = null;

        if (mt_rand(1, 100) > 50) {
            $updatedAt = $createdAt->add(new \DateInterval("P".mt_rand(0, 100) . "D"));
        }

        $article = new Article();

        $author = $this->getReference("author".mt_rand(1,AuthorFixtures::$NumberOfRecords));
        $category = $this->getReference("category".mt_rand(1, CategoryFixtures::$numberOfRecords));

        $article->setTitle($this->faker->bs())
                ->setContent($this->faker->realTextBetween(200, 2000))
                ->setCreatedAt($createdAt)
                ->setUpdatedAt($updatedAt)
                ->setAuthor($author)
                ->setCategory($category);
        $manager->persist($article);

    }

    public function getOrder(){
        return 10;
    }
}
