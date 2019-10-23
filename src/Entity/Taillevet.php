<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Taillevet
 *
 * @ORM\Table(name="taillevet")
 * @ORM\Entity
 */
class Taillevet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_taillevet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTaillevet;

    /**
     * @var string
     *
     * @ORM\Column(name="taille", type="string", length=50, nullable=false)
     */
    private $taille;

    public function getIdTaillevet(): ?int
    {
        return $this->idTaillevet;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }
    public function __toString(){
        return gettype($this->idTaillevet);
        return gettype($this->taille);

    }

}
