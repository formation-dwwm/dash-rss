<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GroupDash
 *
 * @ORM\Table(name="group_dash")

 * @ORM\Entity(repositoryClass="App\Repository\GroupDashRepository")

 */
class GroupDash
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
     * @ORM\Column(name="groupName", type="string", length=255, nullable=false)
     */
    private $groupname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Theme", mappedBy="idGroupDash")
     */
    private $idTheme;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idTheme = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupname(): ?string
    {
        return $this->groupname;
    }

    public function setGroupname(string $groupname): self
    {
        $this->groupname = $groupname;

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

    /**
     * @return Collection|Theme[]
     */
    public function getIdTheme(): Collection
    {
        return $this->idTheme;
    }

    public function addIdTheme(Theme $idTheme): self
    {
        if (!$this->idTheme->contains($idTheme)) {
            $this->idTheme[] = $idTheme;
            $idTheme->addIdGroupDash($this);
        }

        return $this;
    }

    public function removeIdTheme(Theme $idTheme): self
    {
        if ($this->idTheme->contains($idTheme)) {
            $this->idTheme->removeElement($idTheme);
            $idTheme->removeIdGroupDash($this);
        }

        return $this;
    }


}

