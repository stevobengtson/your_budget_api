<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: '`category_group`')]
#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"]
)]
class CategoryGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\OneToMany(targetEntity: 'Category', mappedBy: 'category_group', cascade: ['persist', 'remove'])]
    #[ApiSubresource(maxDepth: 1)]
    public iterable $categories;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 3, nullable: false)]
    public float $assigned = 0.0;

    #[ORM\Column(type: 'string', length: 1024)]
    public string $name = '';

    public function getId(): ?int
    {
        return $this->id;
    }
}
