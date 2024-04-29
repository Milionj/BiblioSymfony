<?php

namespace App\Entity;

use App\Repository\BorrowingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BorrowingRepository::class)]
class Borrowing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $borrowing_at = null;

    #[ORM\Column]
    private ?int $total = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $due_date_at = null;

    #[ORM\Column]
    private ?bool $is_overdue = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $return_date_at = null;

    #[ORM\ManyToOne(inversedBy: 'borrowing')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $book = null;

    #[ORM\ManyToOne(inversedBy: 'borrowings')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'borrowings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $borrowing_book = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorrowingAt(): ?\DateTimeImmutable
    {
        return $this->borrowing_at;
    }

    public function setBorrowingAt(\DateTimeImmutable $borrowing_at): static
    {
        $this->borrowing_at = $borrowing_at;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getDueDateAt(): ?\DateTimeImmutable
    {
        return $this->due_date_at;
    }

    public function setDueDateAt(\DateTimeImmutable $due_date_at): static
    {
        $this->due_date_at = $due_date_at;

        return $this;
    }

    public function isOverdue(): ?bool
    {
        return $this->is_overdue;
    }

    public function setOverdue(bool $is_overdue): static
    {
        $this->is_overdue = $is_overdue;

        return $this;
    }

    public function getReturnDateAt(): ?\DateTimeImmutable
    {
        return $this->return_date_at;
    }

    public function setReturnDateAt(\DateTimeImmutable $return_date_at): static
    {
        $this->return_date_at = $return_date_at;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): static
    {
        $this->book = $book;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getBorrowingBook(): ?Book
    {
        return $this->borrowing_book;
    }

    public function setBorrowingBook(?Book $borrowing_book): static
    {
        $this->borrowing_book = $borrowing_book;

        return $this;
    }
}
