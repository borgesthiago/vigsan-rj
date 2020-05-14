<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CidadaoRepository")
 */
class Cidadao
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     */
    private $cpf;

    /**
     * @ORM\Column(type="date")
     */
    private $dataNotificacao;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $sivep;

    /**
     * @ORM\Column(type="integer")
     */
    private $idade;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexo;

    /**
     * @ORM\Column(type="date")
     */
    private $dataInicioSintoma;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $internacaoUti;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $usoSuporteVentilatorio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $raioX;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $resultadoExame;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $evolucao;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dataEvolucao;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $observacao;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Unidade", inversedBy="paciente")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unidade;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     */
    private $telefone;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $bairro;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Comorbidade")
     */
    private $comorbidade;

    public function __construct()
    {
        $this->comorbidade = new ArrayCollection();
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

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getDataNotificacao(): ?\DateTimeInterface
    {
        return $this->dataNotificacao;
    }

    public function setDataNotificacao(\DateTimeInterface $dataNotificacao): self
    {
        $this->dataNotificacao = $dataNotificacao;

        return $this;
    }

    public function getSivep(): ?string
    {
        return $this->sivep;
    }

    public function setSivep(?string $sivep): self
    {
        $this->sivep = $sivep;

        return $this;
    }

    public function getIdade(): ?int
    {
        return $this->idade;
    }

    public function setIdade(int $idade): self
    {
        $this->idade = $idade;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getDataInicioSintoma(): ?\DateTimeInterface
    {
        return $this->dataInicioSintoma;
    }

    public function setDataInicioSintoma(\DateTimeInterface $dataInicioSintoma): self
    {
        $this->dataInicioSintoma = $dataInicioSintoma;

        return $this;
    }

    public function getInternacaoUti(): ?string
    {
        return $this->internacaoUti;
    }

    public function setInternacaoUti(string $internacaoUti): self
    {
        $this->internacaoUti = $internacaoUti;

        return $this;
    }

    public function getUsoSuporteVentilatorio(): ?string
    {
        return $this->usoSuporteVentilatorio;
    }

    public function setUsoSuporteVentilatorio(?string $usoSuporteVentilatorio): self
    {
        $this->usoSuporteVentilatorio = $usoSuporteVentilatorio;

        return $this;
    }

    public function getRaioX(): ?string
    {
        return $this->raioX;
    }

    public function setRaioX(?string $raioX): self
    {
        $this->raioX = $raioX;

        return $this;
    }

    public function getResultadoExame(): ?string
    {
        return $this->resultadoExame;
    }

    public function setResultadoExame(?string $resultadoExame): self
    {
        $this->resultadoExame = $resultadoExame;

        return $this;
    }

    public function getEvolucao(): ?string
    {
        return $this->evolucao;
    }

    public function setEvolucao(?string $evolucao): self
    {
        $this->evolucao = $evolucao;

        return $this;
    }

    public function getDataEvolucao(): ?\DateTimeInterface
    {
        return $this->dataEvolucao;
    }

    public function setDataEvolucao(?\DateTimeInterface $dataEvolucao): self
    {
        $this->dataEvolucao = $dataEvolucao;

        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    public function getUnidade(): ?Unidade
    {
        return $this->unidade;
    }

    public function setUnidade(?Unidade $unidade): self
    {
        $this->unidade = $unidade;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(?string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function setBairro(?string $bairro): self
    {
        $this->bairro = $bairro;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Comorbidade[]
     */
    public function getComorbidade(): Collection
    {
        return $this->comorbidade;
    }

    public function addComorbidade(Comorbidade $comorbidade): self
    {
        if (!$this->comorbidade->contains($comorbidade)) {
            $this->comorbidade[] = $comorbidade;
        }

        return $this;
    }

    public function removeComorbidade(Comorbidade $comorbidade): self
    {
        if ($this->comorbidade->contains($comorbidade)) {
            $this->comorbidade->removeElement($comorbidade);
        }

        return $this;
    }
}
