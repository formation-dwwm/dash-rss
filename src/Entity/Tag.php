<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{
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
     * @ORM\Column(name="tag", type="string", length=255, nullable=false)
     */
    private $tag;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Post", inversedBy="idContent")
     * @ORM\JoinTable(name="content",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_content", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_post", referencedColumnName="id")
     *   }
     * )
     */
    private $idPost;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPost = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getIdPost(): Collection
    {
        return $this->idPost;
    }

    public function addIdPost(Post $idPost): self
    {
        if (!$this->idPost->contains($idPost)) {
            $this->idPost[] = $idPost;
        }

        return $this;
    }

    public function removeIdPost(Post $idPost): self
    {
        if ($this->idPost->contains($idPost)) {
            $this->idPost->removeElement($idPost);
        }

        return $this;
    }

}
