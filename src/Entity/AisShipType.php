<?php

namespace App\Entity;

use App\Repository\AisShipTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;

/**
 * @ORM\Entity(repositoryClass=AisShipTypeRepository::class)
 * @ORM\Table(name="aisshiptype")
 */
class AisShipType extends AbstractType {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="Id")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(min=1,
     *              max=9,
     *              minMessage = "Le type d'un navire est compris entre 1 et 9",
     *              maxMessage = "Le type d'un navire est compris entre 1 et 9",
     *              allowEmptyString = false
     *              )
     */
    private $aisShipType;

    /**
     * @ORM\ManyToMany(targetEntity=Port::class, inversedBy="lesTypes")
     */
    private $lesPorts;

    public function __construct()
    {
        $this->lesPorts = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getLibelle(): ?string {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self {
        $this->libelle = $libelle;

        return $this;
    }

    public function getAisShipType(): ?int {
        return $this->aisShipType;
    }

    public function setAisShipType(int $aisShipType): self {
        $this->aisShipType = $aisShipType;

        return $this;
    }

    /**
     * @return Collection|Port[]
     */
    public function getLesPorts(): Collection
    {
        return $this->lesPorts;
    }

    public function addLesPort(Port $lesPort): self
    {
        if (!$this->lesPorts->contains($lesPort)) {
            $this->lesPorts[] = $lesPort;
        }

        return $this;
    }

    public function removeLesPort(Port $lesPort): self
    {
        $this->lesPorts->removeElement($lesPort);

        return $this;
    }

}
