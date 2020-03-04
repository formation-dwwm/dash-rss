<?php

namespace App\Controller;

use App\Entity\Source;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
   
    /**
     * @Route("api/source/{id}", methods={"POST"})
     */
    function updateFeed(Request $req, int $id){

        $data = [];
        if ($content = $req->getContent()) {
            $data = json_decode($content, true);
        }

        // Update source if exists
        $entityManager = $this->getDoctrine()->getManager();
        $source = $this->getDoctrine()->getRepository(Source::class)->find($id);

        if (!$source) {
            throw $this->createNotFoundException(
                'No source found for id '.$id
            );
        }

        $source->setName($data['name']);
        $source->setRssUrl($data['url']);
        $entityManager->persist($source);
        $entityManager->flush();

        $res = new JsonResponse([
            "success" => true
        ]);


        $res->headers->set('Access-Control-Allow-Origin', '*');

        return $res;
    }

    /**
     * @Route("api/source/{id}", methods={"DELETE"})
     */
    function removeFeed(Request $req, int $id){
        $data = [];
        if ($content = $req->getContent()) {
            $data = json_decode($content, true);
        }

        // Delete source if exists
        $entityManager = $this->getDoctrine()->getManager();
        $source = $this->getDoctrine()->getRepository(Source::class)->find($id);

        if (!$source) {
            throw $this->createNotFoundException(
                'No source found for id '.$id
            );
        }

        $entityManager->remove($source);
        $entityManager->flush();

        $res = new JsonResponse([
            "success" => true
        ]);

        $res->headers->set('Access-Control-Allow-Origin', '*');

        return $res;
    }

}