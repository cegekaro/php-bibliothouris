<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/submitIsbn", name="bibl.book.api.searchByIsbn")
     * @Method({"GET"})
     * @return Response
     */
    public function getBooksByIsbn(Request $request)
    {
        $isbn            = $request->get('isbn');
        $allMatchedBooks = $this->get('bibl.book.api.book')->getBooksByIsbn($isbn);

        return new Response(json_encode($allMatchedBooks));

    }
}
