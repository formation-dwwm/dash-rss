<?php

namespace App\Controller;

use App\Entity\Source;
use App\Entity\Theme;
use App\Entity\Tag;
use App\Form\Type\SourceType;
use App\Form\Type\ThemeType;
use App\Form\Type\TagType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\sourceRepository;


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
    * @Route("/config/rss", name="config_rss")
    * @Route("/config", name="config")
    */
    public function configuration_rss(Request $request)
    {
        $page_title = 'Configuration des flux RSS';

        $source = new Source();

        $addForm = $this->createForm(SourceType::class, $source);
        $addForm->handleRequest($request);
        if ($addForm->isSubmitted() && $addForm->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$source` variable has also been updated
            $source = $addForm->getData();
    
            // ... perform some action, such as saving the source to the database
            // for example, if Source is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($source);
            $entityManager->flush();
    
            return $this->redirectToRoute('config_rss');
        }

        $repository = $this->getDoctrine()->getRepository(Source::class);
        $feeds = $repository->findAll();

        return $this->render('config/config_rss.html.twig', [
            'name' => 'Ajouter un nouveau flux RSS', 'page_title' => $page_title, 'formConfigRSS' => $addForm->createView(), 'feeds' => $feeds
        ]);
    }

    /**
    * @Route("/config/themes", name="config_themes")
    */
    public function configuration_themes(Request $request)
    {
        $page_title = 'Configuration des thèmes';
        
        $themes = new Theme();

        $addForm = $this->createForm(ThemeType::class, $themes);
        $addForm->handleRequest($request);
        if ($addForm->isSubmitted() && $addForm->isValid()) {
            $themes = $addForm->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($themes);
            $entityManager->flush();
    
            return $this->redirectToRoute('config_themes');
        }

        $repository = $this->getDoctrine()->getRepository(Theme::class);
        $themes = $repository->findAll();

        return $this->render('config/config_themes.html.twig', [
            'name' => 'Configuration des thèmes', 'page_title' => $page_title, 'formConfigTheme' => $addForm->createView(), 'themes' => $themes
        ]);
    }

    /**
    * @Route("/config/tags", name="config_tags")
    */
    public function configuration_tags(Request $request)
    {
        $page_title = 'Configuration des mots-clés';

        $tags = new Tag();

        $addForm = $this->createForm(TagType::class, $tags);
        $addForm->handleRequest($request);
        if ($addForm->isSubmitted() && $addForm->isValid()) {
            $tags = $addForm->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tags);
            $entityManager->flush();
    
            return $this->redirectToRoute('config_tags');
        }

        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tags = $repository->findAll();

        return $this->render('config/config_tags.html.twig', [
            'name' => 'Configuration Mots-clés', 'page_title' => $page_title, 'formConfigTag' => $addForm->createView(), 'tags' => $tags
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

