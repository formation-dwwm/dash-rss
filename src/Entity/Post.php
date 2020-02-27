<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post", indexes={@ORM\Index(name="post_theme0_FK", columns={"id_theme"}), @ORM\Index(name="post_source_FK", columns={"id_source"})})
 *  @ORM\Entity(repositoryClass="App\Repository\PostRepository")
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
     * @ORM\Column(type="string", length=255)
     */
    private $post_url;

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

    public function getPostUrl(): ?string
    {
        return $this->post_url;
    }

    public function setPostUrl(string $post_url): self
    {
        $this->post_url = $post_url;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getAlert(): ?bool
    {
        return $this->alert;
    }

    public function setAlert(bool $alert): self
    {
        $this->alert = $alert;

        return $this;
    }

    public function getIdSource(): ?Source
    {
        return $this->idSource;
    }

    public function setIdSource(?Source $idSource): self
    {
        $this->idSource = $idSource;

        return $this;
    }

    public function getIdTheme(): ?Theme
    {
        return $this->idTheme;
    }

    public function setIdTheme(?Theme $idTheme): self
    {
        $this->idTheme = $idTheme;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getIdContent(): Collection
    {
        return $this->idContent;
    }

    public function addIdContent(Tag $idContent): self
    {
        if (!$this->idContent->contains($idContent)) {
            $this->idContent[] = $idContent;
            $idContent->addIdPost($this);
        }

        return $this;
    }

    public function removeIdContent(Tag $idContent): self
    {
        if ($this->idContent->contains($idContent)) {
            $this->idContent->removeElement($idContent);
            $idContent->removeIdPost($this);
        }

        return $this;
    }
}
