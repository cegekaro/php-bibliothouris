<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Governs the API's methods
 *
 * @package ApiBundle\Controller
 * @author  Daniela Cruceanu
 */
class ApiController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/submit_isbn", name="bibl.book.api.search_by_isbn", options={"expose"=true})
     * @Method({"POST"})
     * @return Response
     */
    public function getBooksByIsbn(Request $request)
    {
        $isbn            = $request->get('isbn');
        $allMatchedBooks = $this->get('bibl.book.api.book')->getBooksByIsbn($isbn);

        return new Response(json_encode($allMatchedBooks));
    }

}
