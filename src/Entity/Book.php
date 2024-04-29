<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $publication_at = null;

    #[ORM\Column(length: 255)]
    private ?string $image_name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $uptdated_at = null;

    #[ORM\Column]
    private ?bool $is_available = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?Autor $autor = null;

    /**
     * @var Collection<int, Borrowing>
     */
    #[ORM\OneToMany(targetEntity: Borrowing::class, mappedBy: 'book')]
    private Collection $borrowing;

    /**
     * @var Collection<int, Borrowing>
     */
    #[ORM\OneToMany(targetEntity: Borrowing::class, mappedBy: 'borrowing_book', orphanRemoval: true)]
    private Collection $borrowings;

    #[ORM\ManyToOne(inversedBy: 'book')]
    #[ORM\JoinColumn(nullable: false)]
    private ?State $state = null;

    public function __construct()
    {
        $this->borrowing = new ArrayCollection();
        $this->borrowings = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPublicationAt(): ?\DateTimeImmutable
    {
        return $this->publication_at;
    }

    public function setPublicationAt(\DateTimeImmutable $publication_at): static
    {
        $this->publication_at = $publication_at;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->image_name;
    }

    public function setImageName(string $image_name): static
    {
        $this->image_name = $image_name;

        return $this;
    }

    public function getUptdatedAt(): ?\DateTimeImmutable
    {
        return $this->uptdated_at;
    }

    public function setUptdatedAt(\DateTimeImmutable $uptdated_at): static
    {
        $this->uptdated_at = $uptdated_at;

        return $this;
    }

    public function isAvailable(): ?bool
    {
        return $this->is_available;
    }

    public function setAvailable(bool $is_available): static
    {
        $this->is_available = $is_available;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getAutor(): ?Autor
    {
        return $this->autor;
    }

    public function setAutor(?Autor $autor): static
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * @return Collection<int, Borrowing>
     */
    public function getBorrowing(): Collection
    {
        return $this->borrowing;
    }

    public function addBorrowing(Borrowing $borrowing): static
    {
        if (!$this->borrowing->contains($borrowing)) {
            $this->borrowing->add($borrowing);
            $borrowing->setBook($this);
        }

        return $this;
    }

    public function removeBorrowing(Borrowing $borrowing): static
    {
        if ($this->borrowing->removeElement($borrowing)) {
            // set the owning side to null (unless already changed)
            if ($borrowing->getBook() === $this) {
                $borrowing->setBook(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Borrowing>
     */
    public function getBorrowings(): Collection
    {
        return $this->borrowings;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): static
    {
        $this->state = $state;

        return $this;
    }
}
