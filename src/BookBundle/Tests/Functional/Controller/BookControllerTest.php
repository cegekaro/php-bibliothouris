<?php


namespace BookBundle\Tests\Functional\Controller;


use BookBundle\Tests\Functional\AbstractFunctionalTest;

class BookControllerTest extends AbstractFunctionalTest
{
    public function testListAllBooksAction()
    {
        $this->getClient()->request('GET', '/book/all/1');
        $this->assertSuccessfulResponse('Could not load basic book listing page');

        $crawler = $this->getClient()->getCrawler();
        $nextPage = $crawler->selectLink('Page 2')->link();

        $this->getClient()->click($nextPage);
        $this->assertSuccessfulResponse();
    }
}
