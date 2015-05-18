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

    public function retrieveNumberOfBooks()
    {
        return $this->getObjectManager()->getRepository('BookBundle:Book')->getNumberOfBooks();
    }

    public function saveBook($book)
    {
        return $this->getObjectManager()->getRepository('BookBundle:Book')->saveBook($book);
    }

    public function getBookById($id)
    {
        return $this->getObjectManager()->getRepository('BookBundle:Book')->getBookById($id);
    }

}
