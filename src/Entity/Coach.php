<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coach
 *
 * @ORM\Table(name="coach")
 * @ORM\Entity
 */
class Coach
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcoach", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcoach;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_prenom", type="string", length=50, nullable=false)
     */
    private $nomPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="date", nullable=false)
     */
    private $dob;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=50, nullable=false)
     */
    private $image;


}
