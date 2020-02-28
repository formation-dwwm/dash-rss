<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
   
    /**
     * @Route("api/source", methods={"POST"})
     */
    function updateFeed(Request $req){

        $data = [];
        if ($content = $req->getContent()) {
            $data = json_decode($content, true);
        }

        // Update source if exists

        $res = new JsonResponse([
            "success" => true
        ]);


        $res->headers->set('Access-Control-Allow-Origin', '*');

        return $res;
    }

    /**
     * @Route("api/source", methods={"DELETE"})
     */
    function removeFeed(Request $req){
        $data = [];
        if ($content = $req->getContent()) {
            $data = json_decode($content, true);
        }

        // Del source if exists

        $res = new JsonResponse([
            "success" => true
        ]);

        $res->headers->set('Access-Control-Allow-Origin', '*');

        return $res;
    }

}