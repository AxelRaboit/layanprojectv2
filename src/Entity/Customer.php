<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasAnswered;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasConsumed;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $lastEmailDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getHasAnswered(): ?bool
    {
        return $this->hasAnswered;
    }

    public function setHasAnswered(bool $hasAnswered): self
    {
        $this->hasAnswered = $hasAnswered;

        return $this;
    }

    public function getHasConsumed(): ?bool
    {
        return $this->hasConsumed;
    }

    public function setHasConsumed(bool $hasConsumed): self
    {
        $this->hasConsumed = $hasConsumed;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getLastEmailDate(): ?\DateTimeInterface
    {
        return $this->lastEmailDate;
    }

    public function setLastEmailDate(\DateTimeInterface $lastEmailDate): self
    {
        $this->lastEmailDate = $lastEmailDate;

        return $this;
    }
}
