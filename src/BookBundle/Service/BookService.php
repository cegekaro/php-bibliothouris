<?php


namespace BookBundle\Service;


class BookService extends AbstractService
{
    /**
     * @param $limit
     * @param $offset
     *
     * @return array
     */
    public function retrieveAllBooks($limit, $offset)
    {
        return $this->getObjectManager()->getRepository('BookBundle:Book')->retrieveBooks($limit, $offset);
    }
}
