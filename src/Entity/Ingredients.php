<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredients
 *
 * @ORM\Table(name="ingredients")
 * @ORM\Entity
 */
class Ingredients
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Recipes", mappedBy="ingredients")
     */
    private $recipes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recipes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecipes()
    {
        return $this->recipes;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $recipes
     *
     * @return self
     */
    public function setRecipes(\Doctrine\Common\Collections\Collection $recipes)
    {
        $this->recipes = $recipes;

        return $this;
    }
}
