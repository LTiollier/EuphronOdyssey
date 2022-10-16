<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TrainingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource()]
#[ORM\Entity(repositoryClass: TrainingRepository::class)]
class Training
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'trainings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?SubProgram $subProgram = null;

    #[ORM\OneToMany(mappedBy: 'training', targetEntity: TrainingSerie::class, orphanRemoval: true)]
    private Collection $trainingSeries;

    public function __construct()
    {
        $this->trainingSeries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSubProgram(): ?SubProgram
    {
        return $this->subProgram;
    }

    public function setSubProgram(?SubProgram $subProgram): self
    {
        $this->subProgram = $subProgram;

        return $this;
    }

    /**
     * @return Collection<int, TrainingSerie>
     */
    public function getTrainingSeries(): Collection
    {
        return $this->trainingSeries;
    }

    public function addTrainingSeries(TrainingSerie $trainingSeries): self
    {
        if (!$this->trainingSeries->contains($trainingSeries)) {
            $this->trainingSeries->add($trainingSeries);
            $trainingSeries->setTraining($this);
        }

        return $this;
    }

    public function removeTrainingSeries(TrainingSerie $trainingSeries): self
    {
        if ($this->trainingSeries->removeElement($trainingSeries)) {
            // set the owning side to null (unless already changed)
            if ($trainingSeries->getTraining() === $this) {
                $trainingSeries->setTraining(null);
            }
        }

        return $this;
    }
}
