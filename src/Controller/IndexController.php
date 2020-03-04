<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/")
     * @Route("/index", name="index")
     */
    
    public function index(PostRepository $repo)
    {
        $posts = $repo->findAll();

        return $this->render('index/index.html.twig', [
            'page_title' => "Le Dash",
            'controller_name' => 'IndexController',
            'posts' => $posts,
        ]);
    }
}