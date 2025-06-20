<?php

namespace App\Entity;

use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
class Burger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    /**
     * @var Collection<int, Ingredient>
     */
    #[ORM\ManyToMany(targetEntity: Ingredient::class, mappedBy: 'burgers')]
    private Collection $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'image' => $this->getImage(),
            'description' => $this->getDescription(),
            'type' => $this->getType(),
            'price' => $this->getPrice(),
            'ingredients' => array_map(fn($ingredient) => [
                'id' => $ingredient->getId(),
                'name' => $ingredient->getName()
            ], $this->getIngredients()->toArray()), // récupère la collection d'ingrédients
        ];
    }

  /**
   * @return Collection<int, Ingredient>
   */
  public function getIngredients(): Collection
  {
      return $this->ingredients;
  }

  public function addIngredient(Ingredient $ingredient): static
  {
      if (!$this->ingredients->contains($ingredient)) {
          $this->ingredients->add($ingredient);
          $ingredient->addBurger($this);
      }

      return $this;
  }

  public function removeIngredient(Ingredient $ingredient): static
  {
      if ($this->ingredients->removeElement($ingredient)) {
          $ingredient->removeBurger($this);
      }

      return $this;
  }
}
