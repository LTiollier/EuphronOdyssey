<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramRepository::class)]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'program', targetEntity: SubProgram::class)]
    private Collection $subPrograms;

    public function __construct()
    {
        $this->subPrograms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, SubProgram>
     */
    public function getSubPrograms(): Collection
    {
        return $this->subPrograms;
    }

    public function addSubProgram(SubProgram $subProgram): self
    {
        if (!$this->subPrograms->contains($subProgram)) {
            $this->subPrograms->add($subProgram);
            $subProgram->setProgram($this);
        }

        return $this;
    }

    public function removeSubProgram(SubProgram $subProgram): self
    {
        if ($this->subPrograms->removeElement($subProgram)) {
            // set the owning side to null (unless already changed)
            if ($subProgram->getProgram() === $this) {
                $subProgram->setProgram(null);
            }
        }

        return $this;
    }
}
