<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MammalRepository")
 */
class Mammal extends Pet
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $breed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $long_fur;

    public function getBreed(): ?string
    {
        return $this->breed;
    }

    public function setBreed(string $breed): self
    {
        $this->breed = $breed;

        return $this;
    }

    public function getLongFur(): ?bool
    {
        return $this->long_fur;
    }

    public function setLongFur(bool $long_fur): self
    {
        $this->long_fur = $long_fur;

        return $this;
    }
}
