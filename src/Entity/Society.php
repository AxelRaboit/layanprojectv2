<?php

namespace App\Entity;

use App\Repository\SocietyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocietyRepository::class)
 */
class Society
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="integer")
     */
    private $siret;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="society")
     */
    private $collaborator;

    public function __construct()
    {
        $this->collaborator = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(int $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getCollaborator(): Collection
    {
        return $this->collaborator;
    }

    public function addCollaborator(User $collaborator): self
    {
        if (!$this->collaborator->contains($collaborator)) {
            $this->collaborator[] = $collaborator;
            $collaborator->setSociety($this);
        }

        return $this;
    }

    public function removeCollaborator(User $collaborator): self
    {
        if ($this->collaborator->removeElement($collaborator)) {
            // set the owning side to null (unless already changed)
            if ($collaborator->getSociety() === $this) {
                $collaborator->setSociety(null);
            }
        }

        return $this;
    }
}
