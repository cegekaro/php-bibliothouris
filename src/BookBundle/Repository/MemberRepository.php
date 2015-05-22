<?php


namespace BookBundle\Repository;


class MemberRepository extends AbstractEntityRepository
{

    public function saveMember($member)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($member);
        $entityManager->flush();
    }

    public function getAllMembers()
    {
        $members = $this->getEntityManager()->createQuery(
                "SELECT m FROM BookBundle\Entity\Member m")->getResult();

        return $members;
    }
}
