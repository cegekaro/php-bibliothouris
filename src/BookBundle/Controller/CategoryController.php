<?php


namespace BookBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller {

    /**
     * @Route('/get_categories', name="bibl.book.category.get_all");
     * @Method({"GET"})
     * @return array
     */
    public function actionGetAllCategories() {
        $categories = $this->get('bibl.book.service.category')->getAllCategories();

        return $categories;
    }
}
