<?php

/**
 * Description of Product
 *
 * @author lmalicki
 */

namespace Polcode\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Poduct
 * 
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product {

    /**
     * @ORM\Column(name="product_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $product_id;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * 
     * @var string Product name
     */
    private $product_name;

    /**
     * @ORM\Column(type="text")
     * 
     * @var text Product description
     */
    private $product_description;

    /**
     * @ORM\Column(name="price", type="decimal", precision=4, scale=2)
     *
     * @var decimal Product price
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     *
     * @var Category
     */
    private $category;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;
    
    public function __toString() {
        return $this->getName();
    }
    
    public function getName() {
        return $this->proxyCurrentLocaleTranslation('getName', array());
    }

    /**
     * Get product_id
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set product_name
     *
     * @param string $productName
     * @return Product
     */
    public function setProductName($productName)
    {
        $this->product_name = $productName;

        return $this;
    }

    /**
     * Get product_name
     *
     * @return string 
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * Set product_description
     *
     * @param string $productDescription
     * @return Product
     */
    public function setProductDescription($productDescription)
    {
        $this->product_description = $productDescription;

        return $this;
    }

    /**
     * Get product_description
     *
     * @return string 
     */
    public function getProductDescription()
    {
        return $this->product_description;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Product
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set category
     *
     * @param \Polcode\ProductBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\Polcode\ProductBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Polcode\ProductBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
