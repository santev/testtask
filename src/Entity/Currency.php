<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;

use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
#[UniqueConstraint(name: "unique_currency_idx", columns: ["name"])]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'currency:item']),
        new GetCollection(normalizationContext: ['groups' => 'currency:list'])
    ],
    paginationEnabled: false,
)]
class Currency
{
    #[ORM\Id, ORM\GeneratedValue('IDENTITY'), ORM\Column]
    #[Groups(['currency:list', 'currency:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['currency:list', 'currency:item'])]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
