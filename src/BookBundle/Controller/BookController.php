<?php


namespace BookBundle\Controller;


use BookBundle\Entity\Book;
use BookBundle\Form\BookTask;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Governs the methods exposed regarding books.
 *
 * @package BookBundle\Controller
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class BookController extends Controller
{
    const  NUMBER_OF_ITEMS_PER_PAGE = 5;

    /**
     * @param int $page
     *
     * @Route("/all/{page}", name="bibl.book.book.all")
     * @Method({"GET"})
     * @return Response
     */
    public function listAllBooksAction($page = 1)
    {
        $limit  = self::NUMBER_OF_ITEMS_PER_PAGE;
        $offset = ($page - 1) * self::NUMBER_OF_ITEMS_PER_PAGE;

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
                try {
                    $this->get('bibl.book.service.book')->saveBook($book);
                    $this->addFlash('notice', 'Book was successfully saved!');
                } catch (\PDOException $e) {
                    $this->addFlash('notice', 'The server encountered a problem.');
                }

                return $this->redirectToRoute('bibl.book.book.add');
            }
        }

        return $this->render('@Book/Book/add-book.html.twig', [
            'form'    => $form->createView(),
            'newBook' => true
        ]);
    }

    /**
     * @param Request $request
     *
     * @Route("/edit/{id}", name = "bibl.book.book.edit")
     * @return mixed
     */
    public function editBookByIdAction(Request $request)
    {
        $book = $this->get('bibl.book.service.book')->getBookById($request->get('id'));

        if (null === $book) {
            return $this->redirectToRoute("bibl.book.book.add");
        }

        $form = $this->createForm(new BookTask(), $book);

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isValid()) {
                try {
                    $this->get("bibl.book.service.book")->saveBook($book);
                    $this->addFlash('notice', "The book was successfully updated! ");
                } catch (\PDOException $e) {
                    $this->addFlash('notice', "The server encountered a problem.");
                }
            }
        }

        return $this->render('@Book/Book/add-book.html.twig', [
            'form'    => $form->createView(),
            'book'    => $book,
            'newBook' => false
        ]);
    }

    /**
     * @param Request $request
     *
     * @Route("/view/{id}", name = "bibl.book.book.view")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewBookByIdAction(Request $request)
    {
        try {
            $currentBook = $this->get("bibl.book.service.book")->getBookById($request->get('id'));
        } catch (\ORMException $e) {
        }

        if (null === $currentBook) {
            return $this->redirectToRoute("bibl.book.book.add");
        }

        return $this->render('@Book/Book/view-book.html.twig', [
            'book' => $currentBook
        ]);
    }

    /**
     *
     * @Route("/search_by_isbn", name = "bibl.book.book.list_search_by_isbn")
     * @return Response
     */
    public function searchBookByIsbn()
    {
        return $this->render('BookBundle:Book:search-by-isbn.html.twig');
    }

    /**
     * @param Request $request
     *
     * @Route("/render_books", name="bibl.book.book.ajax_render_books", options={"expose"=true})
     * @Method({"POST"})
     *
     * @return Response
     */
    public function renderBooksAfterSubmit(Request $request)
    {
        if ($request->get('isbn')) {
            $field = "isbn";
            $info  = $request->get('isbn');
        } else if ($request->get('title')) {
            $field = "title";
            $info  = $request->get('title');
        }

        $books = $this->get('bibl.book.api.book')->getBooksByInfo($field, $info);

        return $this->render('@Book/Book/_ajax-all-books-by-isbn.html.twig', [
            'books' => $books
        ]);
    }

    /**
     * @Route("/search_by_title", name = "bibl.book.book.list_search_by_title")
     * @return Response
     */
    public function searchBookByTitle() {
        return $this->render('@Book/Book/search_by_title.html.twig');
    }
}
