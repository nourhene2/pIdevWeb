<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Reclamations
 *
 * @ORM\Table(name="reclamations")
 * @ORM\Entity
 */
class Reclamations
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_r", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idR;

     /**
     * @var string
     *
     * @ORM\Column(name="contenu_r", type="string", length=255, nullable=false)
     *  @Assert\NotBlank(message="Veuillez insérer du contenu ! c'est obligatoire !")
     */
    private $contenuR;

    /**
     * @var string
     *
     * @ORM\Column(name="type_r", type="string", length=255, nullable=false)
     */
    private $typeR;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_r", type="date", nullable=false)
     */
    private $dateR;

    public function getIdR(): ?int
    {
        return $this->idR;
    }

    public function getContenuR(): ?string
    {
        return $this->contenuR;
    }

    public function setContenuR(string $contenuR): self
    {
        $this->contenuR = $contenuR;

        return $this;
    }

    public function getTypeR(): ?string
    {
        return $this->typeR;
    }

    public function setTypeR(string $typeR): self
    {
        $this->typeR = $typeR;

        return $this;
    }

    public function getDateR(): ?\DateTimeInterface
    {
        return $this->dateR;
    }

    public function setDateR(\DateTimeInterface $dateR): self
    {
        $this->dateR = $dateR;

        return $this;
    }


}
