<?php

namespace ApiBundle\Tests\Functional\Controller;

use BookBundle\Tests\Functional\AbstractFunctionalTest;

class ApiControllerText extends AbstractFunctionalTest {

    public function testGetBooksByInfo()
    {
        $this->getClient()->request('POST', '/api/submit_info', [
            "isbn" => "000.000.001"
        ]);

        $this->assertSuccessfulResponse('Could not access the api method when submitting the isbn');

        $this->getClient()->request('POST', '/api/submit_info', [
            "title" => "Title 1"
        ]);

        $this->assertSuccessfulResponse('Could not access the api method when submitting the title');
    }

}
