<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $book = new Book();
        $book   ->setTitre("titre1")
                ->setAuteur("auteur1")
                ->setEditeur("editeur1")
                ->setGenre("genre1")
                ->setPrix(1);
        $manager->persist($book);
        $manager->flush();
    }
}
