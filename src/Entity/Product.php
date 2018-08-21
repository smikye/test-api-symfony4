<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ProductUnit;
use App\Entity\TimeUnit;

/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="ProductUnit", inversedBy="products")
     * @ORM\JoinColumn(name="prod_unit_id", referencedColumnName="id")
     *

     */
    private $prodUnit;

    /**
     * @ORM\ManyToOne(targetEntity="TimeUnit", inversedBy="products")
     * @ORM\JoinColumn(name="time_unit_id", referencedColumnName="id")
     *

     */
    private $timeUnit;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

    public function __construct()
    {
        $this->amount = 0;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set prodUnit
     *
     * @param object $prodUnitId
     *
     * @return Product
     */
    public function setProdUnitId($prodUnitId)
    {
        $this->prodUnit = $prodUnitId;

        return $this;
    }

    /**
     * Get prodUnit
     *
     * @return object
     */
    public function getProdUnitId()
    {
        return $this->prodUnit;
    }

    /**
     * Set timeUnit
     *
     * @param object $timeUnit
     *
     * @return Product
     */
    public function setTimeUnit($timeUnit)
    {
        $this->timeUnit = $timeUnit;

        return $this;
    }

    /**
     * Get timeUnit
     *
     * @return object
     */
    public function getTimeUnit()
    {
        return $this->timeUnit;
    }

    /**
     * Set amount
     *
     * @param int $amount
     *
     * @return Product
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }
}

