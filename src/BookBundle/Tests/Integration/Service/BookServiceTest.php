<?php


namespace BookBundle\Tests\Integration\Service;


use BookBundle\Entity\Book;
use BookBundle\Service\BookService;
use BookBundle\Tests\Integration\AbstractIntegrationTest;

class BookServiceTest extends AbstractIntegrationTest
{
    /**
     * @var BookService
     */
    protected $bookService;

    public function setUp()
    {
        parent::setUp();

        $this->bookService = $this->getContainer()->get('bibl.book.service.book');
    }

    public function testRetrieveAllBooks()
    {
        $results = $this->bookService->retrieveAllBooks(5, 0);

        $this->assertInternalType('array', $results);
        $this->assertCount(5, $results);

        /** @var Book $result */
        foreach ($results as $result) {
            $this->assertNotNull($result);
            $this->assertInstanceOf('\BookBundle\Entity\Book', $result);
            $this->assertNotNull($result->getId());
        }
    }

    public function testGetBookByIsbn() {

    }

    /**
     * @depends testGetBookByIsbn
     */
    public function testAddNewBook() {
        $book = new Book();
        $book->setIsbn("000.001");
        $book->setAuthorFirstName("Mihail");
        $book->setAuthorLastName("Drumes");

        $this->bookService->saveBook($book);


    }

    public function testGetBookById() {
        $id = 2;
        /* @var Book $secondBook */
        $secondBook = $this->bookService->getBookById($id);

        $this->assertInstanceOf('\BookBundle\Entity\Book', $secondBook);
        $this->assertNotNull($secondBook->getIsbn());
        $this->assertNotNull($secondBook->getAuthorFirstName());
        $this->assertNotNull($secondBook->getAuthorLastName());

    }

}
