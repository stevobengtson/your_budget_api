<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: '`payee`')]
#[ApiResource()]
class Payee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: 'Budget', inversedBy: 'payees', cascade: ['persist', 'remove'])]
    public ?Budget $budget = null;

    #[ORM\Column(type: 'string', length: 1024)]
    #[Assert\NotBlank]
    public string $name = '';

    public function getId(): ?int
    {
        return $this->id;
    }
}
