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
     * @Route("/all/{page}", name="bibl.book.book.all")
     * @Method({"GET"})
     */
    public function listAllBooksAction($page = 1)
    {
        $limit = $page * 5;
        $offset = ($page-1) * 5;

        $books = $this->get('bibl.book.service.book')->retrieveAllBooks($limit, $offset);

        return $this->render('@Book/Book/all-books.html.twig', [
            'books' => $books
        ]);
    }
}
