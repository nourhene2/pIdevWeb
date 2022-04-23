<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;



/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="fk", columns={"nomC"})})
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="idC", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idc;

   
    /**
     * @Assert\NotBlank(message="Le champ nom est obligatoire * ")
     * @ORM\Column(type="text") 
     *  @Groups("post:read")
     * @ORM\Column(type="string", length=255)
     */
    private $nomProduit;
     /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomc;

    /**
     * @Assert\NotBlank(message="Le champs quantite est obligatoire * ")
     * @ORM\Column(type="text") 
     *  @Groups("post:read")
     * @ORM\Column(type="string", length=255)
     */
    private $quantite;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getIdc(): ?int
    {
        return $this->idc;
    }

    public function getNomc(): ?string
    {
        return $this->nomc;
    }

    public function setNomc(string $nomc): self
    {
        $this->nomc = $nomc;

        return $this;
    }

    

   


    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): self
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): self
    {
        $this->quantite = $quantite;

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


}
