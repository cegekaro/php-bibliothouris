<?php


namespace BookBundle\Tests\Functional\Controller;


use BookBundle\Tests\Functional\AbstractFunctionalTest;
use Doctrine\Common\Collections\ArrayCollection;

class BookControllerTest extends AbstractFunctionalTest
{
    public function testListAllBooksAction()
    {
        $this->getClient()->request('GET', '/book/all/1');
        $this->assertSuccessfulResponse('Could not load basic book listing page');

        $crawler  = $this->getClient()->getCrawler();
        $nextPage = $crawler->selectLink('>>')->link();

        $this->getClient()->click($nextPage);
        $this->assertSuccessfulResponse();
    }

    public function testAddNewBook()
    {
        $client  = $this->getClient();
        $crawler = $client->request('GET', '/book/add/');
        $this->assertSuccessfulResponse('Could not access the adding book page');

        $form = $crawler->selectButton('Save')->form();
        $form->setValues(array(
            'book[isbn]'             => '0-201-53082-1',
            'book[authorFirstName]'  => "Test",
            'book[authorLastName]'   => "Test",
            'book[title]'            => "Test",
            'book[categories]'       => new ArrayCollection([1]),
            'book[pages]'            => 200,
            'book[publication_date]' => new \DateTime(),
            'book[publisher]'        => 'Test'
        ));

        $newCrawler = $this->getClient()->submit($form);
        $this->assertTrue($newCrawler->filter('div:contains("successfully")')->count() > 0);

    }

    public function testEditBook()
    {
        $crawler = $this->getClient()->request('GET', '/book/edit/1');
        $this->assertSuccessfulResponse('Could not access the edit page of the first book');

        $form = $crawler->selectButton('Save')->form();
        $form->setValues(array(
            'book[isbn]' => '0-201-53082-1'
        ));

        $afterSubmitCrawler = $this->getClient()->submit($form);
        $this->assertTrue($afterSubmitCrawler->filter('div:contains("successfully updated")')->count() > 0);
    }

    public function testViewBook()
    {
        $this->getClient()->request('GET', '/book/view/2');
        $this->assertSuccessfulResponse('Could not access the view page of the second book');
    }

    public function testListBooksByIsbn()
    {
        $this->getClient()->request('POST', '/book/render_books', [
            "isbn" => "000.000.001"
        ]);

        $this->assertSuccessfulResponse('Could not access the render books method');
    }

    public function testFilterBooks()
    {

        $this->getClient()->request('POST', '/book/show_filtered_books', [
            "field" => "isbn",
            "value" => "000-000",
            "order" => "ASC"
        ]);

        $this->assertSuccessfulResponse('The filtering method does not work');

    }

    public function testFilterBooksAdvanced()
    {

        $this->getClient()->request('POST', '/book/show_filtered_books', [
            "field" => "isbn",
            "value" => "000.000.00' ; drop table book;",
            "order" => "ASC"
        ]);

    }


}
