<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GroupDash
 *
 * @ORM\Table(name="group_dash")
 * @ORM\Entity
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

}
