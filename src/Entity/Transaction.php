<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: '`transaction`')]
#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    collectionOperations: [
        "get" => ["security" => "object.account.budget.user == user"],
        "post" => ["security" => "object.account.budget.user == user"],
    ],
    itemOperations: [
        "get" => ["security" => "object.account.budget.user == user"],
        "put" => ["security" => "object.account.budget.user == user"],
    ],
)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: 'Account', inversedBy: 'transactions', cascade: ['persist', 'remove'])]
    public ?Account $account = null;

    #[ORM\Column(type: 'datetime')]
    public ?\DateTimeInterface $date = null;

    #[ORM\OneToOne(targetEntity: 'Payee')]
    private ?Payee $payee = null;

    #[ORM\OneToOne(targetEntity: 'Category')]
    private ?Category $category = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 3, nullable: false)]
    public float $credit = 0.0;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 3, nullable: false)]
    public float $debit = 0.0;

    #[ORM\Column(type: 'boolean', nullable: false)]
    public bool $cleared = false;

    public function getId(): ?int
    {
        return $this->id;
    }
}
