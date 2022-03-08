<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: '`budget_month`')]
#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"]
)]
class BudgetMonth
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: 'Budget', inversedBy: 'budget_months', cascade: ['persist', 'remove'])]
    public ?Budget $budget = null;

    #[ORM\OneToMany(targetEntity: 'BudgetMonthCategory', mappedBy: 'budget_month', cascade: ['persist', 'remove'])]
    #[ApiSubresource(maxDepth: 1)]
    public iterable $budget_month_categories;

    #[ORM\Column(type: 'integer')]
    public int $year = 0;

    #[ORM\Column(type: 'integer')]
    public int $month = 0;

    public function getId(): ?int
    {
        return $this->id;
    }
}
