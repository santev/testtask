<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\ItemController;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[UniqueConstraint(name: "unique_item_idx", columns: ["name", "category_id"])]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'item:item']),
        new GetCollection(normalizationContext: ['groups' => 'item:list']),
        new Post(
            name: 'item_setprice',
            routeName: 'item_setprice',
            uriTemplate: '/api/items/{id}/setprice',
            denormalizationContext: ['groups' => 'post'],
            validationContext: ['groups' => 'post'],
            controller: ItemController::class,
        ),
    ],
    paginationEnabled: false,
)]
class Item
{
    #[ORM\Id, ORM\GeneratedValue('IDENTITY'), ORM\Column]
    #[Groups(['item:list', 'item:item', 'post'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['item:list', 'item:item'])]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'items'), ORM\JoinColumn(nullable: false)]
    #[Groups(['item:list', 'item:item'])]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: Price::class, orphanRemoval: true)]
    #[Groups(['item:list', 'item:item'])]
    private Collection $prices;

    #[Assert\NotNull(), Assert\NotBlank()]
    #[Groups(['post'])]
    public ?string $sizeId = null;
    
    #[Assert\NotNull(), Assert\NotBlank()]
    #[Groups(['post'])]
    public ?string $currencyId = null;
    
    #[Assert\Regex('\d{0,2}(\.\d{1,2})?', 'Achtung!',null,true)]
    #[Groups(['post'])]
    public ?string $decimal = null;

    public function __construct()
    {
        $this->prices = new ArrayCollection();
    }

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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
            $price->setItem($this);
        }

        return $this;
    }

    public function removePrice(Price $price): self
    {
        if ($this->prices->removeElement($price)) {
            // set the owning side to null (unless already changed)
            if ($price->getItem() === $this) {
                $price->setItem(null);
            }
        }

        return $this;
    }
}
