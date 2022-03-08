<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: '`budget_month_category`')]
#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"]
)]
class BudgetMonthCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: 'BudgetMonth', inversedBy: 'budget_month_categories', cascade: ['persist', 'remove'])]
    public ?BudgetMonth $budget_month = null;

    #[ORM\Column(type: 'decimal', precision:12, scale:3, nullable: false)]
    public float $assigned = 0.0;
    
    public function getId(): ?int
    {
        return $this->id;
    }
}
