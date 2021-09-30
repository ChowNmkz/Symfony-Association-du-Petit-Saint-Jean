<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\OneToMany(targetEntity=ImportPhoto::class, mappedBy="evenement")
     */
    private $import_photo;

    public function __construct()
    {
        $this->import_photo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection|ImportPhoto[]
     */
    public function getImportPhoto(): Collection
    {
        return $this->import_photo;
    }

    public function addImportPhoto(ImportPhoto $importPhoto): self
    {
        if (!$this->import_photo->contains($importPhoto)) {
            $this->import_photo[] = $importPhoto;
            $importPhoto->setEvenement($this);
        }

        return $this;
    }

    public function removeImportPhoto(ImportPhoto $importPhoto): self
    {
        if ($this->import_photo->removeElement($importPhoto)) {
            // set the owning side to null (unless already changed)
            if ($importPhoto->getEvenement() === $this) {
                $importPhoto->setEvenement(null);
            }
        }

        return $this;
    }
}
