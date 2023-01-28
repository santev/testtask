<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;

use App\Repository\SizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SizeRepository::class)]
#[UniqueConstraint(name: "unique_size_idx", columns: ["type","value","category_id"])]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'size:item']),
        new GetCollection(normalizationContext: ['groups' => 'size:list'])
    ],
    paginationEnabled: false,
)]
class Size
{
    #[ORM\Id, ORM\GeneratedValue('IDENTITY'), ORM\Column]
    #[Groups(['size:list', 'size:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['size:list', 'size:item'])]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Groups(['size:list', 'size:item'])]
    private ?string $value = null;

    #[ORM\OneToMany(mappedBy: 'size', targetEntity: Price::class)]
    #[Groups(['category:list', 'category:item'])]
    private Collection $prices;

    #[ORM\ManyToOne(inversedBy: 'sizes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['category:list', 'category:item'])]
    private ?Category $category = null;

    public function __construct()
    {
        $this->prices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
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

    /**
     * @return Collection<int, Price>
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(Price $price): self
    {
        if (!$this->prices->contains($price)) {
            $this->prices->add($price);
            $price->setSize($this);
        }

        return $this;
    }

    public function removePrice(Price $price): self
    {
        if ($this->prices->removeElement($price)) {
            // set the owning side to null (unless already changed)
            if ($price->getSize() === $this) {
                $price->setSize(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
