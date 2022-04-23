<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email( message="l adresse  n est pas valide")
       * @Assert\NotBlank(message="Le champs EMAIL est obligatoire * ")
     * @Groups("post:read")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     
    * @Groups("post:read")
     */
    private $password;

    

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified= false ;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $isBlocked = false ;

   

    /**
     * @ORM\Column(type="string", length=255)
      * @Assert\NotBlank(message="Le champs nom est obligatoire * ")
     * @Groups("post:read")
     */
    private $username;

    /**
     * @ORM\OneToMany(targetEntity=Regime::class, mappedBy="user")
     */
    private $regimes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

  
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fullname;

 
 
    public function __construct()
    {
        $this->regimes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

   

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
 public function __toString(): ?string 
                               {
                                   return $this->id;
                               }
    
    public function getIsBlocked(): ?bool
    {
        return $this->isBlocked;
    }

    public function setIsBlocked(bool $isBlocked): self
    {
        $this->isBlocked = $isBlocked;

        return $this;
    }
   
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection<int, Regime>
     */
    public function getRegimes(): Collection
    {
        return $this->regimes;
    }

    public function addRegime(Regime $regime): self
    {
        if (!$this->regimes->contains($regime)) {
            $this->regimes[] = $regime;
            $regime->setUser($this);
        }

        return $this;
    }

    public function removeRegime(Regime $regime): self
    {
        if ($this->regimes->removeElement($regime)) {
            // set the owning side to null (unless already changed)
            if ($regime->getUser() === $this) {
                $regime->setUser(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(?string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }
     


}