<?php


namespace BookBundle\Tests\Functional\Controller;


use BookBundle\Tests\Functional\AbstractFunctionalTest;

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
            'book[isbn]'            => '123443',
            'book[authorFirstName]' => "Ana",
            'book[authorLastName]'  => "Ana",
            'book[title]'           => "Ana are mere 222",
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
            'book[isbn]' => 'newIsbn'
        ));

        $afterSubmitCrawler = $this->getClient()->submit($form);
        $this->assertTrue($afterSubmitCrawler->filter('div:contains("successfully updated")')->count() > 0);
    }

    public function testViewBook()
    {
        $this->getClient()->request('GET', '/book/view/2');
        $this->assertSuccessfulResponse('Could not access the view page of the second book');

    }


}
