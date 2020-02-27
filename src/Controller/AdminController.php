<?php

namespace App\Controller;

use App\Entity\Source;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\SourceType;

class AdminController extends AbstractController
{
    /**
    * @Route("/pinboard", name="pinboard", methods = {"GET"})
    */
    public function pinBoard()
    {
        $page_title = 'Pin Board';
        return $this->render('pinboard/index.html.twig', [
            'name' => 'Pin Board', 'page_title' => $page_title
        ]);
    }

    /**
    * @Route("/", name="home", methods = {"GET"})
    * @Route("/feed", name="feed", methods = {"GET"})
    */
    public function feed()
    {
        $page_title = 'Tous les flux';
        return $this->render('flux/index.html.twig', [
            'name' => 'Le Flux', 'page_title' => $page_title
        ]);
    }

    /**
    * @Route("/sendbox", name="sendbox", methods = {"GET"})
    */
    public function sendBox()
    {
        $page_title = 'Boîte d\'envoi';
        return $this->render('sendbox/index.html.twig', [
            'name' => 'Boîte d\'envoi', 'page_title' => $page_title
        ]);
    }

    /**
    * @Route("/trash", name="trash", methods = {"GET"})
    */
    public function trash()
    {
        $page_title = 'Articles supprimés';
        return $this->render('trash/index.html.twig', [
            'name' => 'Corbeille', 'page_title' => $page_title
        ]);
    }

    /**
    * @Route("/config/rss", name="config_rss", methods = {"GET"})
    *  @Route("/config", name="config", methods = {"GET"})
    */
    public function configuration_rss()
    {
        // $feeds = FETCH_WITH_SQL('posts');
        $feeds = [
            [
                "name" => "01Net",
                "rss_url" => "http://01.net.com/rss/actus.xml"
            ],
            [
                "name" => "02Net",
                "rss_url" => "http://01.net.com/rss/actus.xml"
            ],
            [
                "name" => "03Net",
                "rss_url" => "http://01.net.com/rss/actus.xml"
            ],
            [
                "name" => "04Net",
                "rss_url" => "http://01.net.com/rss/actus.xml"
            ],
            [
                "name" => "01Net",
                "rss_url" => "http://01.net.com/rss/actus.xml"
            ],
            [
                "name" => "02Net",
                "rss_url" => "http://01.net.com/rss/actus.xml"
            ],
            [
                "name" => "03Net",
                "rss_url" => "http://01.net.com/rss/actus.xml"
            ],
            [
                "name" => "04Net",
                "rss_url" => "http://01.net.com/rss/actus.xml"
            ]
        ];
        
        $page_title = 'Configuration des flux RSS';
        return $this->render('config/config_rss.html.twig', [
            'name' => 'Configuration Flux RSS', 'page_title' => $page_title, 'feeds' => $feeds
        ]);
    }

    /**
     * @Route("/config/create_rss", name="create_rss")
     */
    public function createRssUrl(Request $request)
    {
        $page_title = 'Ajouter un nouveau flux RSS';


        $source = new Source();

        $form = $this->createForm(SourceType::class, $source);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $source = $form->getData();
    
            // ... perform some action, such as saving the task to the database
            // for example, if Source is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($source);
            $entityManager->flush();
    
            return $this->redirectToRoute('config_rss');
        }

        return $this->render('config/create_rss.html.twig', [
            'name' => 'Ajouter un nouveau flux RSS', 'page_title' => $page_title, 'formConfig' => $form->createView(),
        ]);
    }

    /**
    * @Route("/config/themes", name="config_themes", methods = {"GET"})
    */
    public function configuration_themes()
    {
        $page_title = 'Configuration des thèmes';
        return $this->render('config/config.html.twig', [
            'name' => 'Configuration Thèmes', 'page_title' => $page_title
        ]);
    }

    /**
    * @Route("/config/tags", name="config_tags", methods = {"GET"})
    */
    public function configuration_tags()
    {
        $page_title = 'Configuration des mots-clés';
        return $this->render('config/config.html.twig', [
            'name' => 'Configuration Mots-clés', 'page_title' => $page_title
        ]);
    }

    /**
    * @Route("/config/authors", name="config_authors", methods = {"GET"})
    */
    public function configuration_authors()
    {
        $page_title = 'Configuration des auteurs';
        return $this->render('config/config.html.twig', [
            'name' => 'Configuration Auteurs', 'page_title' => $page_title
        ]);
    }
}

