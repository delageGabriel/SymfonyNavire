<?php

namespace App\Entity;

use App\Repository\PortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PortRepository::class)
 * @ORM\Table(  name="port" ,
 *            uniqueConstraints={@ORM\UniqueConstraint(name="portindicatif_unique",columns={"indicatif"})}
 * )
 */
class Port {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=5)
     * @Assert\Regex(
     *     pattern="/[A-Z]{5}/",
     *     message="L'indicatif du Port a strictement 5 caractères"
     * )
     */
    private $indicatif;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class)
     * @ORM\JoinColumn(nullable=false , name="idpays") 
     */
    private $lePays;

    /**
     * @ORM\ManyToMany(targetEntity=AisShipType::class, mappedBy="lesPorts")
     */
    private $lesTypes;

    public function __construct()
    {
        $this->lesTypes = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(string $nom): self {
        $this->nom = $nom;

        return $this;
    }

    public function getIndicatif(): ?string {
        return $this->indicatif;
    }

    public function setIndicatif(string $indicatif): self {
        $this->indicatif = $indicatif;

        return $this;
    }

    public function getLePays(): ?Pays {
        return $this->lePays;
    }

    public function setLePays(?Pays $lePays): self {
        $this->lePays = $lePays;

        return $this;
    }

    /**
     * @return Collection|AisShipType[]
     */
    public function getLesTypes(): Collection
    {
        return $this->lesTypes;
    }

    public function addLesType(AisShipType $lesType): self
    {
        if (!$this->lesTypes->contains($lesType)) {
            $this->lesTypes[] = $lesType;
            $lesType->addLesPort($this);
        }

        return $this;
    }

    public function removeLesType(AisShipType $lesType): self
    {
        if ($this->lesTypes->removeElement($lesType)) {
            $lesType->removeLesPort($this);
        }

        return $this;
    }

}