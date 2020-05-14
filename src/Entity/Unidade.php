<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UnidadeRepository")
 */
class Unidade
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cidadao", mappedBy="unidade")
     */
    private $paciente;

    public function __construct()
    {
        $this->paciente = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return Collection|Cidadao[]
     */
    public function getPaciente(): Collection
    {
        return $this->paciente;
    }

    public function addPaciente(Cidadao $paciente): self
    {
        if (!$this->paciente->contains($paciente)) {
            $this->paciente[] = $paciente;
            $paciente->setUnidade($this);
        }

        return $this;
    }

    public function removePaciente(Cidadao $paciente): self
    {
        if ($this->paciente->contains($paciente)) {
            $this->paciente->removeElement($paciente);
            // set the owning side to null (unless already changed)
            if ($paciente->getUnidade() === $this) {
                $paciente->setUnidade(null);
            }
        }

        return $this;
    }
}
