<?php


namespace BookBundle\Repository;


use Doctrine\ORM\PersistentCollection;

class BookRepository extends AbstractEntityRepository
{
    /**
     * @param $limit
     * @param $offset
     *
     * @return array
     */
    public function retrieveBooks($limit, $offset)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT b
            FROM BookBundle\Entity\Book b
        ");

        $query->setMaxResults($limit);
        $query->setFirstResult($offset);

        return $query->getResult();
    }

    /**
     * @return array
     */
    public function getNumberOfBooks()
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT COUNT(b)
            FROM BookBundle\Entity\Book b
        ");

        return $query->getSingleScalarResult();
    }

    public function saveBook($book)
    {
        try {
            $entityManager = $this->getEntityManager();
            $entityManager->persist($book);
            $entityManager->flush();
        } catch (\Exception $e) {
            return false;
        }

        return true;

    }

    public function getBookById($id)
    {
        $book = $this->getEntityManager()->find('BookBundle:Book', $id);

        return $book;

    }
}
