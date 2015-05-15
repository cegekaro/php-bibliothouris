<?php


namespace BookBundle\Controller;


use BookBundle\Entity\Book;
use BookBundle\Form\BookTask;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        $limit  = $page * 5;
        $offset = ($page - 1) * 5;

        $books         = $this->get('bibl.book.service.book')->retrieveAllBooks($limit, $offset);
        $numberOfBooks = $this->get('bibl.book.service.book')->retrieveNumberOfBooks();

        return $this->render('@Book/Book/all-books.html.twig', [
            'books'         => $books,
            'numberOfBooks' => $numberOfBooks
        ]);
    }

    /**
     * @param Request $request
     * @Route("/add/", name = "bibl.book.book.add")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addBook(Request $request)
    {
        $book = new Book();
        $form = $this->createForm(new BookTask(), $book);

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isValid()) {
                // add a flash message
                $this->get('bibl.book.service.book')->saveBook($book);
                $this->addFlash('notice', 'Cartea a fost salvata cu succes!');

                return $this->redirectToRoute('bibl.book.book.add');
            }
        }

        return $this->render('@Book/Book/add-book.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
