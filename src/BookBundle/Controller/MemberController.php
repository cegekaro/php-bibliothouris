<?php


namespace BookBundle\Controller;


use BookBundle\Entity\Member;
use BookBundle\Form\MemberTask;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MemberController extends Controller
{

    /**
     * @param Request $request
     *
     * @Route("/add", name= "bibl.book.member.add")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addNewMember(Request $request)
    {
        $member = new Member();
        $form   = $this->createForm(new MemberTask(), $member);

        if($request->isMethod('POST')) {
            $form->submit($request->get($form->getName()));

            if($form->isValid()) {
                try {
                    $this->get('bibl.book.service.member')->saveMember($member);
                    $this->addFlash('notice', 'Member successfully added');
                }
                catch(\PDOException $e) {
                    $this->addFlash('notice', 'The server encountered a problem');
                }

                $this->redirectToRoute('bibl.book.member.add');
            }
        }

        return $this->render('@Book/Book/add-member.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     *
     * @Route("/all", name = "bibl.book.member.all")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function actionListAllMembers() {

        $members = $this->get('bibl.book.service.member')->getAllMembers();

        return $this->render('@Book/Book/all-members.html.twig', [
            'members' => $members
        ]);
    }

}
