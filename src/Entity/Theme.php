<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 *
 * @ORM\Table(name="theme")
 * @ORM\Entity(repositoryClass="App\Repository\ThemeRepository")
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|GroupDash[]
     */
    public function getIdGroupDash(): Collection
    {
        return $this->idGroupDash;
    }

    public function addIdGroupDash(GroupDash $idGroupDash): self
    {
        if (!$this->idGroupDash->contains($idGroupDash)) {
            $this->idGroupDash[] = $idGroupDash;
        }

        return $this;
    }

    public function removeIdGroupDash(GroupDash $idGroupDash): self
    {
        if ($this->idGroupDash->contains($idGroupDash)) {
            $this->idGroupDash->removeElement($idGroupDash);
        }

        return $this;
    }

}
