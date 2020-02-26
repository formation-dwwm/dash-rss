<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity
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

}
