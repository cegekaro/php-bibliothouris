<?php

namespace ApiBundle\Service;

use BookBundle\Service\AbstractService;


class ApiService extends AbstractService {

    /**
     * @param $isbn
     *
     * @return Book[]
     */
    public function getBooksByIsbn($isbn) {
        return $this->getObjectManager()->getRepository('BookBundle:Book')->getBooksByIsbn($isbn);
    }
}
