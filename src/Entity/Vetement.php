<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vetement
 *
 * @ORM\Table(name="vetement", indexes={@ORM\Index(name="id_typevet", columns={"id_typevet"}), @ORM\Index(name="id_coloris", columns={"id_coloris"}), @ORM\Index(name="id_taille", columns={"id_taille"})})
 * @ORM\Entity
 */
class Vetement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_vet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVet;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_vet", type="string", length=50, nullable=false)
     */
    private $nomVet;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var \Coloris
     *
     * @ORM\ManyToOne(targetEntity="Coloris")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_coloris", referencedColumnName="id_coloris")
     * })
     */
    private $idColoris;

    /**
     * @var \Taillevet
     *
     * @ORM\ManyToOne(targetEntity="Taillevet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_taille", referencedColumnName="id_taillevet")
     * })
     */
    private $idTaille;

    /**
     * @var \Type
     *
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_typevet", referencedColumnName="id_typevet")
     * })
     */
    private $idTypevet;

    public function getIdVet(): ?int
    {
        return $this->idVet;
    }

    public function getNomVet(): ?string
    {
        return $this->nomVet;
    }

    public function setNomVet(string $nomVet): self
    {
        $this->nomVet = $nomVet;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIdColoris(): ?Coloris
    {
        return $this->idColoris;
    }

    public function setIdColoris(?Coloris $idColoris): self
    {
        $this->idColoris = $idColoris;

        return $this;
    }

    public function getIdTaille(): ?Taillevet
    {
        return $this->idTaille;
    }

    public function setIdTaille(?Taillevet $idTaille): self
    {
        $this->idTaille = $idTaille;

        return $this;
    }

    public function getIdTypevet(): ?Type
    {
        return $this->idTypevet;
    }

    public function setIdTypevet(?Type $idTypevet): self
    {
        $this->idTypevet = $idTypevet;

        return $this;
    }
    public function __toString(){
        // to show the name of the Category in the select
        return gettype($this->idVet);
        return gettype($this->nomVet);
        return gettype($this->prix);
        return gettype($this->image);
        return gettype($this->idColoris);
        return gettype($this->idTaille);
       


        // to show the id of the Category in the select
        // return $this->id;
    }

}
