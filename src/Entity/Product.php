<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     * @Assert\Length(max=50)
     */
    private $name;
    
      /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Length(max=30)
     */
    private $product_id;
    
     /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(max=30)
     */
    private $manager;
    
     /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $sales_start_date;
    
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
    
    public function getProductId(): ?int
    {
        return $this->product_id;

        return $this;
    }    
    
    public function setProductId(string $product_id): self
    {
       $this->product_id = $product_id;

        return $this;
    }

    public function getManager(): ?string
    {
        return $this->manager;

        return $this;
    }    
    
    public function setManager(string $manager): self
    {
       $this->manager = $manager;

        return $this;
    }
    
    public function getSalesStartDate(): ?string
    {
        return $this->sales_start_date;

        return $this;
    }    
    
    public function setSalesStartDate(string $sales_start_date): self
    {
       $this->sales_start_date = $sales_start_date;

        return $this;
    }
}
