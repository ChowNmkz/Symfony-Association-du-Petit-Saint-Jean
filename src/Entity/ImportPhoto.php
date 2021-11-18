<?php

namespace App\Entity;

use App\Repository\ImportPhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ImportPhotoRepository::class)
 */
class ImportPhoto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /** 
     * @Assert\All({
     *  @Assert\NotBlank,
     *  @Assert\Length(min=5)
     * })
    */
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path_photo;

    /**
     * @ORM\ManyToOne(targetEntity=Evenement::class, inversedBy="import_photo", cascade={"persist"})
     */
    private $evenement;

    public function __construct()
    {
        $this->Date = new \DateTime('now');
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

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getPathPhoto(): ?string
    {
        return $this->path_photo;
    }

    public function setPathPhoto(string $path_photo): self
    {
        $this->path_photo = $path_photo;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }
}
