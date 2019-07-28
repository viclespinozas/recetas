<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Recipes
 *
 * @ORM\Table(name="recipes")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Recipes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="preparation", type="text", length=65535, nullable=true)
     */
    private $preparation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="recipes", fileNameProperty="image")
     * 
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RecipesHasIngredients", mappedBy="recipes", cascade={"persist"})
     */
    private $ingredients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PreparationImage", mappedBy="recipes", cascade={"persist"})
     */
    private $preparationImages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->preparationImages = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function __toString()
    {
        if ($this->id) {
            return (string)$this->name;
        } else {
            return '';
        }
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|null $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPreparation()
    {
        return $this->preparation;
    }

    /**
     * @param string|null $preparation
     *
     * @return self
     */
    public function setPreparation($preparation)
    {
        $this->preparation = $preparation;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     *
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @return Collection|RecipesHasIngredients[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(RecipesHasIngredients $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->setRecipes($this);
        }

        return $this;
    }

    public function removeIngredient(RecipesHasIngredients $ingredient): self
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecipes() === $this) {
                $ingredient->setRecipes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PreparationImages[]
     */
    public function getPreparationImages(): Collection
    {
        return $this->preparationImages;
    }

    public function addPreparationImage(PreparationImage $preparationImage): self
    {
        if (!$this->preparationImages->contains($preparationImage)) {
            $this->preparationImages[] = $preparationImage;
            $preparationImage->setRecipes($this);
        }

        return $this;
    }

    public function removePreparationImage(PreparationImage $preparationImage): self
    {
        if ($this->preparationImages->contains($preparationImage)) {
            $this->preparationImages->removeElement($preparationImage);
            // set the owning side to null (unless already changed)
            if ($preparationImage->getRecipes() === $this) {
                $preparationImage->setRecipes(null);
            }
        }

        return $this;
    }
}
