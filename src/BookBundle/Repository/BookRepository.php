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

    /**
     * @param $book
     */
    public function saveBook($book)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($book);
        $entityManager->flush();
    }

    /**
     * @param $id
     *
     * @return \BookBundle\Entity\Book
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getBookById($id)
    {
        $book = $this->getEntityManager()->find('BookBundle:Book', $id);

        return $book;

    }

    /**
     * @param $isbn
     *
     * @return array
     */
    public function getBooksByIsbn($isbn)
    {
        $books = $this->createQueryBuilder("b")
            ->where("b.isbn LIKE :isbn")
            ->setParameter(":isbn", "%{$isbn}%")->getQuery()->getArrayResult();

        return $books;
    }
}
