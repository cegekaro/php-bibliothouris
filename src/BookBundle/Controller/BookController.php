<?php


namespace BookBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Governs the methods exposed regarding books.
 *
 * @package BookBundle\Controller
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class BookController extends Controller
{
    /**
     * @Route("/all", name="bibl.book.book.all")
     * @Method({"GET"})
     */
    public function listAllBooksAction($page = 1)
    {
        return $this->render('@Book/Book/all-books.html.twig');
    }
}
