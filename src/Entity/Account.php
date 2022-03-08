<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: '`account`')]
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
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 1024)]
    #[Assert\NotBlank]
    public string $name = '';

    #[ORM\Column(type: 'text')]
    public string $description = '';

    #[ORM\Column(type: 'decimal', precision:12, scale:3, nullable: false)]
    public float $balance = 0.0;

    #[ORM\ManyToOne(targetEntity: 'Budget', inversedBy: 'accounts', cascade: ['persist', 'remove'])]
    public ?Budget $budget = null;

    #[ORM\OneToMany(targetEntity: 'Transaction', mappedBy: 'account', cascade: ['persist', 'remove'])]
    #[ApiSubresource(maxDepth: 1)]
    public iterable $transactions;

    public function getId(): ?int
    {
        return $this->id;
    }
}