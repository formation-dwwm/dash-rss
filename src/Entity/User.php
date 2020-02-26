<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="user_group_dash_FK", columns={"id_group_dash"})})
 * @ORM\Entity
 */
class User
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
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var \GroupDash
     *
     * @ORM\ManyToOne(targetEntity="GroupDash")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_group_dash", referencedColumnName="id")
     * })
     */
    private $idGroupDash;


}
