<?php

/**
 * Description of Product
 *
 * @author lmalicki
 */

namespace Polcode\ProductBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity
 * @ORM\Table(name="product", schema="product")
 * @ORM\Entity(repositoryClass="Polcode\ProductBundle\Entity\ProductRepository")
 * 
 */
class Product {

    use ORMBehaviors\Translatable\Translatable;
    
    /**
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="price", type="float", scale=2)
     *
     * @var decimal Product price
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @var Category
     */
    private $category;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    public function __construct() {
        $this->translations = new ArrayCollection();
    }

    public function __toString() {
        return $this->getName();
    }

    public function getName() {
        return $this->proxyCurrentLocaleTranslation('getName', array());
    }
    
    public function setName($name) {
        $this->translate( 'en' )->setName($name);
        $this->mergeNewTranslations();
        return $this;
    }

    public function getDescription() {
        return $this->proxyCurrentLocaleTranslation('getDescription', array());
    }
    
    public function setDescription($description) {
        $this->translate('en')->setDescription($description);
        $this->mergeNewTranslations();
        return $this;
    }

    public function getSlug() {
        return $this->proxyCurrentLocaleTranslation('getSlug', array());
    }
    
    public function setSlug($slug) {
        $this->translate('en')->setSlug($slug);
        $this->mergeNewTranslations();
        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Product
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Product
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set category
     *
     * @param \Polcode\ProductBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\Polcode\ProductBundle\Entity\Category $category) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Polcode\ProductBundle\Entity\Category 
     */
    public function getCategory() {
        return $this->category;
    }

}
