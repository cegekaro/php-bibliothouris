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
}
