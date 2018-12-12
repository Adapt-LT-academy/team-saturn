<?php
/**
 * Created by PhpStorm.
 * User: macbookair
 * Date: 2018-12-12
 * Time: 09:31
 */

namespace App\Entity;


class Pet
{
    private $id;
    private $species;
    private $breed;
    private $gender;
    private $price = 0;

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getSpecies(): String
    {
        return $this->species;
    }

    /**
     * @param mixed $species
     * @return Pet
     */
    public function setSpecies(String $species): self
    {
        $this->species = $species;
    }

    /**
     * @return mixed
     */
    public function getBreed(): String
    {
        return $this->breed;
    }

    /**
     * @param mixed $breed
     * @return Pet
     */
    public function setBreed($breed): self
    {
        $this->breed = $breed;
    }


    /**
     * @return mixed
     */
    public function getGender(): String
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     * @return Pet
     */
    public function setGender($gender): self
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return Pet
     */
    public function setPrice(int $price): self
    {
        $this->price = $price;
    }


}