<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post", indexes={@ORM\Index(name="post_theme0_FK", columns={"id_theme"}), @ORM\Index(name="post_source_FK", columns={"id_source"})})
 * @ORM\Entity
 */
class Post
{
    
    const STATE_TRIAGE = 'triage';
    const STATE_PUBLISHED = 'published';
    const STATE_REMOVED = 'removed';
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=false)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255, nullable=false)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=false)
     */
    private $state;

    /**
     * @var bool
     *
     * @ORM\Column(name="alert", type="boolean", nullable=false)
     */
    private $alert;

    /**
     * @var \Source
     *
     * @ORM\ManyToOne(targetEntity="Source")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_source", referencedColumnName="id")
     * })
     */
    private $idSource;

    /**
     * @var \Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_theme", referencedColumnName="id")
     * })
     */
    private $idTheme;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="idPost")
     */
    private $idContent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idContent = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function setState($state){
        if (!in_array($state, array(self::STATE_TRIAGE, self::STATE_PUBLISHED, self::STATE_REMOVED))) {
            throw new \InvalidArgumentException("État non reconnu");
        }
    }
}
