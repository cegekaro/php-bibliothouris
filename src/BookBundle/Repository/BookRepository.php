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
     * @param $field
     * @param $info
     *
     * @return array
     */
    public function getBooksByInfo($field, $info)
    {
        $condition = "b.{$field} LIKE :{$field}";
        $books = $this->createQueryBuilder("b")
            ->where($condition)
            ->setParameter(":{$field}", "%{$info}%")->getQuery()->getArrayResult();

        return $books;
    }
    
    public function filterBookByFields($field, $value, $order) {
        $books = $this->createQueryBuilder("b")
                    ->where("b.{$field} LIKE :{$field}")
                    ->orderBy("b.{$field}", $order)
                    ->setParameter(":{$field}", "%{$value}%")
                    ->getQuery()
                    ->getArrayResult();
        
        return $books;
            
    }
}
