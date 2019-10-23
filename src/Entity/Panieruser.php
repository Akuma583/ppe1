<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panieruser
 *
 * @ORM\Table(name="panieruser", indexes={@ORM\Index(name="id_vet", columns={"id_vet"})})
 * @ORM\Entity
 */
class Panieruser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_panieruser", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPanieruser;

    /**
     * @var \Vetement
     *
     * @ORM\ManyToOne(targetEntity="Vetement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_vet", referencedColumnName="id_vet")
     * })
     */
    private $idVet;

    public function getIdPanieruser(): ?int
    {
        return $this->idPanieruser;
    }

    public function getIdVet(): ?Vetement
    {
        return $this->idVet;
    }

    public function setIdVet(?Vetement $idVet): self
    {
        $this->idVet = $idVet;

        return $this;
    }


}
