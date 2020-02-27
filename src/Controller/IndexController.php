<?php

namespace App\Controller;

use App\Repository\GroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/")
     * @Route("/index", name="index")
     */
    public function index(GroupRepository $repo)
    {
        $groups = $repo->findAll();

        

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}