<?php

namespace App\Controller;

use App\Kernel;
use App\Repository\GroupRepository;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Process\Process;
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



    //@TODO: This route should be protected and only present in admin !
    /**
     * @Route("/rss/sync", name="sync_rss")
     */
    public function startSync(KernelInterface $kernel){
        $projectRoot = $kernel->getProjectDir();

        $process = new Process(array('php', $projectRoot.'/bin/console',  'app:rss:sync'));
        $process->start();

        $process->wait();

        $output = $process->getOutput();

        return new JsonResponse([
            "success" => true
            // "jobStarted" => true,
            // "ouput" => $output
        ]);
    }
}