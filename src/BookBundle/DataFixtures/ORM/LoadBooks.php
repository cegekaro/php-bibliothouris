<?php


namespace BookBundle\DataFixtures\ORM;


use BookBundle\Entity\Book;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBooks implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($index = 0; $index < 10; $index++) {
            $book = new Book();

            $book
                ->setIsbn("000.000.00{$index}")
                ->setTitle("Title {$index}")
                ->setAuthorFirstName("Author FName {$index}")
                ->setAuthorLastName("Author LName {$index}");

            $manager->persist($book);
        }

        $manager->flush();
    }

}
