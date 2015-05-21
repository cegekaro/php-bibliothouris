<?php


namespace BookBundle\Service;


class CategoryService extends AbstractService {

    public function getAllCategories() {
        return $this->getObjectManager()->getRepository('BookBundle:Category')->getAllCategories();
    }
}
