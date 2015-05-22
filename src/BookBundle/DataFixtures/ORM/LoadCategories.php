<?php


namespace BookBundle\DataFixtures\ORM;


use BookBundle\Entity\Category;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadCategories implements FixtureInterface
{
    /**
     * Load dummy categories in the database
     *
     * @param ObjectManager $objectManager
     */
    public function load(ObjectManager $objectManager)
    {
        for ($index = 0; $index < 3; $index++) {

            $category = new Category();
            $category->setName("Name " . $index);

            $objectManager->persist($category);
        }

        $objectManager->flush();
    }
}
