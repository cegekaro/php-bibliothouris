<?php

namespace ApiBundle\Service;

use BookBundle\Service\AbstractService;


class ApiService extends AbstractService {

    /**
     * @param $field
     * @param $info
     *
     * @return array
     */
    public function getBooksByInfo($field, $info) {
        return $this->getObjectManager()->getRepository('BookBundle:Book')->getBooksByInfo($field, $info);
    }
}
