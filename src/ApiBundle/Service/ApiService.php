<?php

namespace ApiBundle\Service;

use BookBundle\Service\AbstractService;


class ApiService extends AbstractService {
    public function getBooksByIsbn($isbn) {
        return $this->getObjectManager()->getRepository('BookBundle:Book')->getBooksByIsbn($isbn);
    }
}