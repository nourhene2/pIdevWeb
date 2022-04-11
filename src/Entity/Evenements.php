<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Evenements
 *
 * @ORM\Table(name="evenements")
 * @ORM\Entity
 */
class Evenements
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_e", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idE;

      /**
     * @var string
     *
     * @ORM\Column(name="nom_e", type="string", length=255)
     *  @Assert\NotBlank(message="Veuillez insérer du nom ! c'est obligatoire !")
     * @Assert\Length(
     *     min=5,
     *     max=20,
     *     minMessage="Le nom doit contenir au moins 5 carcatères ",
     *     maxMessage="Le nom doit contenir au plus 20 carcatères"
     * )
     */
    private $nomE;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_e", type="string", length=255, nullable=false)
     */
    private $adresseE;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_pers", type="integer")
     * @Assert\NotNull(message="Le Nombre de participants doît être différent de 0")
     */
    private $nbrPers;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_places", type="integer")
     * @Assert\NotNull(message="Le Nombre de places doît être différent de 0")
     */
    private $nbrPlaces;

  
    
 /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

   /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;

    public function getIdE(): ?int
    {
        return $this->idE;
    }

    public function getNomE(): ?string
    {
        return $this->nomE;
    }

    public function setNomE(string $nomE): self
    {
        $this->nomE = $nomE;

        return $this;
    }

    public function getAdresseE(): ?string
    {
        return $this->adresseE;
    }

    public function setAdresseE(string $adresseE): self
    {
        $this->adresseE = $adresseE;

        return $this;
    }

    public function getNbrPers(): ?int
    {
        return $this->nbrPers;
    }

    public function setNbrPers(int $nbrPers): self
    {
        $this->nbrPers = $nbrPers;

        return $this;
    }

    public function getNbrPlaces(): ?int
    {
        return $this->nbrPlaces;
    }

    public function setNbrPlaces(int $nbrPlaces): self
    {
        $this->nbrPlaces = $nbrPlaces;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }


}
