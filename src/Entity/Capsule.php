<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * Capsule
 *
 * @ORM\Table(name="capsule")
 * @ORM\Entity
 */
class Capsule
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
     * @ORM\Column(name="nomcapsule", type="string", length=255)
    
     */
    private $nomcapsule;

    /**
     * @var string
     *
     * @ORM\Column(name="typecapsule", type="string", length=255, nullable=false)
    
     */
    private $typecapsule;

    /**
     * @var string
     *
     * @ORM\Column(name="longcapsule", type="string", length=50)
     
     * 
     */
    private $longcapsule;

    /**
     * @var string
     *
     * @ORM\Column(name="programmecapsule", type="string", length=255, nullable=false)
     * 
     */
    private $programmecapsule;

    /**
     * @var string
     *
     * @ORM\Column(name="chemincapsule", type="string", length=255, nullable=false)
     */
    private $chemincapsule;

    /**
     * @var string
     *
     * @ORM\Column(name="cible", type="string", length=50, nullable=false)
     */
    private $cible;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=50, nullable=false)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomcapsule(): ?string
    {
        return $this->nomcapsule;
    }

    public function setNomcapsule(string $nomcapsule): self
    {
        $this->nomcapsule = $nomcapsule;

        return $this;
    }

    public function getTypecapsule(): ?string
    {
        return $this->typecapsule;
    }

    public function setTypecapsule(string $typecapsule): self
    {
        $this->typecapsule = $typecapsule;

        return $this;
    }

    public function getLongcapsule(): ?string
    {
        return $this->longcapsule;
    }

    public function setLongcapsule(string $longcapsule): self
    {
        $this->longcapsule = $longcapsule;

        return $this;
    }

    public function getProgrammecapsule(): ?string
    {
        return $this->programmecapsule;
    }

    public function setProgrammecapsule(string $programmecapsule): self
    {
        $this->programmecapsule = $programmecapsule;

        return $this;
    }

    public function getChemincapsule(): ?string
    {
        return $this->chemincapsule;
    }

    public function setChemincapsule(string $chemincapsule): self
    {
        $this->chemincapsule = $chemincapsule;

        return $this;
    }

    public function getCible(): ?string
    {
        return $this->cible;
    }

    public function setCible(string $cible): self
    {
        $this->cible = $cible;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }


}
