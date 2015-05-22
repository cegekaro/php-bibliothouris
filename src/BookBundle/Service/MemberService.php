<?php


namespace BookBundle\Service;

/**
 * Governs all methods for the  Member Service
 *
 * @package BookBundle\Service
 * @author  Daniela Cruceanu <daniela.cruceanu@cegeka.com>
 */
class MemberService extends AbstractService {

    /**
     * @param $member
     */
    public function saveMember($member) {
        $this->getObjectManager()->getRepository('BookBundle:Member')->saveMember($member);
    }

    public function getAllMembers() {
        return $this->getObjectManager()->getRepository('BookBundle:Member')->getAllMembers();
    }
}
