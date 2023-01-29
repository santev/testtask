<?php

namespace App\Entity;

use App\Repository\PriceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;

use Symfony\Component\Serializer\Annotation\Groups;

#[UniqueConstraint(name: "unique_price_idx", columns: ["item_id", "currency_id", "size_id"])]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'price:item']),
        new GetCollection(normalizationContext: ['groups' => 'price:list'])
    ],
    paginationEnabled: false,
)]

#[ORM\Entity(repositoryClass: PriceRepository::class)]
class Price
{
    #[ORM\Id, ORM\GeneratedValue('IDENTITY'), ORM\Column]
    #[Groups(['price:list', 'price:item'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['price:list', 'price:item'])]
    private ?string $value = null;

    #[ORM\ManyToOne, ORM\JoinColumn(nullable: false)]
    #[Groups(['price:list', 'price:item'])]
    private ?Currency $currency = null;

    #[ORM\ManyToOne(inversedBy: 'prices'), ORM\JoinColumn(nullable: false)]
    #[Groups(['price:list', 'price:item'])]
    private ?Item $item = null;

    #[ORM\ManyToOne(inversedBy: 'prices')]
    #[Groups(['price:list', 'price:item'])]
    private ?Size $size = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function setCurrency(?Currency $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getSize(): ?Size
    {
        return $this->size;
    }

    public function setSize(?Size $size): self
    {
        $this->size = $size;

        return $this;
    }
}
