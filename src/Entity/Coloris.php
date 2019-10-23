<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coloris
 *
 * @ORM\Table(name="coloris")
 * @ORM\Entity
 */
class Coloris
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_coloris", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idColoris;

    /**
     * @var string
     *
     * @ORM\Column(name="coloris", type="string", length=50, nullable=false)
     */
    private $coloris;

    public function getIdColoris(): ?int
    {
        return $this->idColoris;
    }

    public function getColoris(): ?string
    {
        return $this->coloris;
    }

    public function setColoris(string $coloris): self
    {
        $this->coloris = $coloris;

        return $this;
    }
    public function __toString(){
        return gettype($this->idColoris);
        return gettype($this->coloris);

    }

}
