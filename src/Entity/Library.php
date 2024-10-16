<?php

namespace App\Entity;

use App\Repository\LibraryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibraryRepository::class)]
class Library
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $website = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    /**
     * @var Collection<int, Author>
     */
    #[ORM\OneToMany(targetEntity: Author::class, mappedBy: 'library')]
    private Collection $ref;

    public function __construct()
    {
        $this->ref = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): static
    {
        $this->website = $website;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection<int, Author>
     */
    public function getRef(): Collection
    {
        return $this->ref;
    }

    public function addRef(Author $ref): static
    {
        if (!$this->ref->contains($ref)) {
            $this->ref->add($ref);
            $ref->setLibrary($this);
        }

        return $this;
    }

    public function removeRef(Author $ref): static
    {
        if ($this->ref->removeElement($ref)) {
            // set the owning side to null (unless already changed)
            if ($ref->getLibrary() === $this) {
                $ref->setLibrary(null);
            }
        }

        return $this;
    }
}
