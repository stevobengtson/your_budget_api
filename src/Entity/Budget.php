<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: '`budget`')]
#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    collectionOperations: [
        "get" => ["security" => "object.user == user"],
        "post" => ["security" => "object.user == user"],
    ],
    itemOperations: [
        "get" => ["security" => "object.user == user"],
        "put" => ["security" => "object.user == user"],
    ],
)]
class Budget
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 1024)]
    #[Assert\NotBlank]
    public string $name = '';

    #[ORM\Column(type: 'date')]
    public ?\DateTimeInterface $startDate = null;

    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'budgets', cascade: ['persist', 'remove'])]
    public ?User $user = null;

    #[ORM\OneToMany(targetEntity: 'Account', mappedBy: 'budget', cascade: ['persist', 'remove'])]
    #[ApiSubresource(maxDepth: 1)]
    public iterable $accounts;

    #[ORM\OneToMany(targetEntity: 'BudgetMonth', mappedBy: 'budget', cascade: ['persist', 'remove'])]
    #[ApiSubresource(maxDepth: 1)]
    public iterable $budget_months;

    #[ORM\OneToMany(targetEntity: 'Payee', mappedBy: 'budget', cascade: ['persist', 'remove'])]
    #[ApiSubresource(maxDepth: 1)]
    public iterable $payees;

    #[ORM\OneToMany(targetEntity: 'Category', mappedBy: 'budget', cascade: ['persist', 'remove'])]
    #[ApiSubresource(maxDepth: 1)]
    public iterable $categories;

    public function getId(): ?int
    {
        return $this->id;
    }
}
