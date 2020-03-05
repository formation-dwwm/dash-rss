<?php

namespace App\Controller;

use App\Entity\Source;
use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
   
    /**
     * @Route("api/configuration/{id}", methods={"POST"})
     */
    function updateFeed(Request $req, int $id) {

        $data = [];
        if ($content = $req->getContent()) {
            $data = json_decode($content, true);
        }

        // Update data if exists
        $entityManager = $this->getDoctrine()->getManager();
        if ($data['entity'] == 'Source') {
            $repository = $this->getDoctrine()->getRepository(Source::class)->find($id);
            $repository->setName($data['name']);
            $repository->setRssUrl($data['url']);
        } else if ($data['entity'] == 'Tag') {
            $repository = $this->getDoctrine()->getRepository(Tag::class)->find($id);
            $repository->setTag($data['tag']);
        }

        if (!$repository) {
            throw $this->createNotFoundException(
                'No data found for id '.$id
            );
        } else {
            $entityManager->persist($repository);
            $entityManager->flush();
            $res = new JsonResponse([
                "success" => true
            ]);
            $res->headers->set('Access-Control-Allow-Origin', '*');
    
            return $res;
        }
    }

    /**
     * @Route("api/configuration/{id}", methods={"DELETE"})
     */
    function removeFeed(Request $req, int $id){
        $data = [];
        if ($content = $req->getContent()) {
            $data = json_decode($content, true);
        }

        // Delete data if exists
        $entityManager = $this->getDoctrine()->getManager();

        if ($data['entity'] == 'Source') {
            $repository = $this->getDoctrine()->getRepository(Source::class)->find($id);
        } else if ($data['entity'] == 'Tag'){
            $repository = $this->getDoctrine()->getRepository(Tag::class)->find($id);
        }
       

        if (!$repository) {
            throw $this->createNotFoundException(
                'No data found for id '.$id
            );
        }
        else {
            $entityManager->remove($repository);
            $entityManager->flush();

            $res = new JsonResponse([
                "success" => true
            ]);

            $res->headers->set('Access-Control-Allow-Origin', '*');

            return $res;
        }
    }

}