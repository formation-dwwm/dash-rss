<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 *
 * @ORM\Table(name="theme")
 * @ORM\Entity
 */
class Theme
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GroupDash", inversedBy="idTheme")
     * @ORM\JoinTable(name="access",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_theme", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_group_dash", referencedColumnName="id")
     *   }
     * )
     */
    private $idGroupDash;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idGroupDash = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
