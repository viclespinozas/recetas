<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PreparationImage
 *
 * @ORM\Table(name="preparation_image", indexes={@ORM\Index(name="fk_preparation_image_recipes_idx", columns={"recipes_id"})})
 * @ORM\Entity
 */
class PreparationImage
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
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @var \Recipes
     *
     * @ORM\ManyToOne(targetEntity="Recipes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="recipes_id", referencedColumnName="id")
     * })
     */
    private $recipes;


}
