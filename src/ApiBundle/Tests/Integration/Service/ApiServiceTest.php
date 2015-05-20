<?php


namespace ApiBundle\Tests\Integration\Service;


use ApiBundle\Service\ApiService;
use BookBundle\Tests\Integration\AbstractIntegrationTest;

class ApiServiceTest extends AbstractIntegrationTest
{

    /**
     * @var ApiService
     */
    protected $apiService;

    public function setUp()
    {
        parent::setUp();

        $this->apiService = $this->getContainer()->get('bibl.book.api.book');
    }

    public function testGetBookByIsbn() {
        $books = $this->apiService->getBooksByInfo("isbn", "000.000.001");
        $notFoundBooks = $this->apiService->getBooksByInfo("isbn", "\0");

        $this->assertInternalType('array', $books);
        $this->assertEquals(1, count($books));
        $this->assertNotNull($books[0]['id']);
        $this->assertEquals("Author FName 1", $books[0]['authorFirstName']);
        $this->assertEquals("Author LName 1", $books[0]['authorLastName']);
        $this->assertEquals("Title 1", $books[0]['title']);
        $this->assertInternalType('array', $notFoundBooks);
        $this->assertEquals(0, count($notFoundBooks));
    }

    public function testGetBookByTitle() {
        $books = $this->apiService->getBooksByInfo("title", "Title 0");
        $notFoundBooks = $this->apiService->getBooksByInfo("title", "\0");

        $this->assertInternalType('array', $books);
        $this->assertNotNull($books[0]['id']);
        $this->assertEquals(1, count($books));
        $this->assertEquals("Author FName 0", $books[0]['authorFirstName']);
        $this->assertEquals("Author LName 0", $books[0]['authorLastName']);
        $this->assertEquals("Title 0", $books[0]['title']);
        $this->assertInternalType('array', $notFoundBooks);
        $this->assertEquals(0, count($notFoundBooks));

    }

}
