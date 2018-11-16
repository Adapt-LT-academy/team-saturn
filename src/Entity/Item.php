<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Item
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     *
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $species = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20)
     */
    protected $size = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20)
     */
    protected $sex = '';

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=11)
     */
    protected $price = 0;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getSpecies(): string
    {
        return $this->species;
    }

    /**
     * @param string $species
     *
     * @return $this
     */
    public function setSpecies(string $species): self
    {
        $this->species = $species;

        return $this;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param string $size
     *
     * @return $this
     */
    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @param string $sex
     *
     * @return $this
     */
    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     *
     * @return $this
     */
    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

}
