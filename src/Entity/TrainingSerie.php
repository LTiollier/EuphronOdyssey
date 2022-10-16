<?php

namespace App\Entity;

use App\Repository\TrainingSerieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingSerieRepository::class)]
class TrainingSerie
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'trainingSeries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Training $training = null;

    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercise $exercise = null;

    #[ORM\Column]
    private ?int $serie = null;

    #[ORM\Column(nullable: true)]
    private ?int $result = null;

    public function getTraining(): ?Training
    {
        return $this->training;
    }

    public function setTraining(?Training $training): self
    {
        $this->training = $training;

        return $this;
    }

    public function getExercise(): ?Exercise
    {
        return $this->exercise;
    }

    public function setExercise(?Exercise $exercise): self
    {
        $this->exercise = $exercise;

        return $this;
    }

    public function getSerie(): ?int
    {
        return $this->serie;
    }

    public function setSerie(int $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getResult(): ?int
    {
        return $this->result;
    }

    public function setResult(?int $result): self
    {
        $this->result = $result;

        return $this;
    }
}
