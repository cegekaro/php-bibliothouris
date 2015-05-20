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
     * @Route("/submit_info", name="bibl.book.api.search_by_info", options={"expose"=true})
     * @Method({"POST"})
     * @return Response
     */
    public function getBooksByInfo(Request $request)
    {
        if ($request->get('isbn')) {
            $field = "isbn";
            $info  = $request->get('isbn');
        } else if ($request->get('title')) {
            $field = "title";
            $info  = $request->get('title');
        }

        $allMatchedBooks = $this->get('bibl.book.api.book')->getBooksByInfo($field, $info);

        return new Response(json_encode($allMatchedBooks));
    }

}
