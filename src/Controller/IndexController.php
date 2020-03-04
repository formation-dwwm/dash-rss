<?php

namespace App\Controller;

use App\Repository\GroupRepository;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use App\Repository\UserRepository;
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
            'controller_name' => 'IndexController',
            'posts' => $posts,
        ]);
    }

}