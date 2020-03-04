<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\GroupDash;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="user_group_dash_FK", columns={"id_group_dash"})})
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @ORM\Column(name="user", type="string", length=255, nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     * HACK
     * @ORM\Column(name="roles",type="string", length=50,nullable=false)
     */
    private $roles = 'user';

    /**
     * @var \GroupDash
     *
     * @ORM\ManyToOne(targetEntity="GroupDash")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_group_dash", referencedColumnName="id")
     * })
     */
    private $idGroupDash;

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(string $roles): ?string
    {
        $this->roles = $roles;

        return $this;
    }

    public function getSalt(): ?string 
    {
        return $this->salt;
    }

    public function getUsername(): ?string
    {
        return $this->user;
    }

    public function eraseCredentials(): void
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getIdGroupDash(): ?GroupDash
    {
        return $this->idGroupDash;
    }

    public function setIdGroupDash(?GroupDash $idGroupDash): self
    {
        $this->idGroupDash = $idGroupDash;

        return $this;
    }


}
