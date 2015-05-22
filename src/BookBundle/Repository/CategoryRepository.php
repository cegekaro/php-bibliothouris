<?php

namespace BookBundle\Repository;

class CategoryRepository extends AbstractEntityRepository
{
    public function getAllCategories()
    {
        $categories = $this->getEntityManager()->createQuery("
                SELECT c FROM BookBundle\Entity\Category c")->getResult();

        return $categories;
    }
}
