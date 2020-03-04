<?php
// src/Command/RssSyncCommand.php
namespace App\Command;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Repository\SourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use FeedIo\FeedIo;

class RssSyncCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:rss:sync';

    protected $feedIo;
    protected $sourceRepository;
    protected $postRepository;
    protected $em;

    public function __construct(FeedIo $feedIo, SourceRepository $sourceRepository, PostRepository $postRepository, EntityManagerInterface $em){
        $this->feedIo = $feedIo;
        $this->sourceRepository = $sourceRepository;
        $this->postRepository = $postRepository;
        $this->em = $em;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Synchronises posts with rss feeds.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command starts rss feeds fetching and syncing with database posts.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'RSS Sync',
            '============',
            '',
        ]);

        $sources = $this->sourceRepository->findAll();

        $n_sources = count($sources);
        $output->writeln('Sources: '.$n_sources);

        foreach($sources as $source){
            $feed = null;
            try{
                $feed = $this->feedIo->read($source->getRssUrl())->getFeed();
            }catch(\Exception $e){
                $output->writeln("ERROR: ".$e->getMessage());
            }

            if($feed){
                foreach($feed as $item){
                    $output->writeln($item->getTitle());

                    //@TODO: Batch checks to avoid making so many requests to SQL...
                    $existingPost = $this->postRepository->findOneBy(array("post_url" => $item->getLink()));

                    if($existingPost){
                        continue;
                    }

                    $post = new Post();
                    $post->setTitle($item->getTitle());
                    $post->setPostUrl($item->getLink());
                    $post->setContent($item->getDescription());
                    $post->setDate($item->getLastModified());
                    $post->setState(POST::STATE_TRIAGE);
                    $post->setAuthor("");
                    $post->setAlert(false);

                    $this->em->persist($post);
                }
            }
        }

        $this->em->flush();


        return 0;
    }
}