<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
        $page_title = 'Le Flux';
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
        $page_title = 'Corbeille';
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

