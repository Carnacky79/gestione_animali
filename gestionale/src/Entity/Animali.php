<?php

namespace App\Entity;

use App\Repository\AnimaliRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "animali")]
#[ORM\Entity(repositoryClass: AnimaliRepository::class)]
class Animali
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $tipo = null;

    #[ORM\Column(length: 255)]
    private ?string $razza = null;

    #[ORM\Column(length: 255)]
    private ?string $taglia = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $data_nascita = null;

    #[ORM\Column]
    private ?float $peso = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $sesso = null;

    #[ORM\Column]
    private ?int $eta = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comportamento = null;

    #[ORM\ManyToOne(inversedBy: 'animali')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clienti $id_cliente = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto = null;

    #[ORM\ManyToMany(targetEntity: Servizi::class, mappedBy: 'animali')]
    private Collection $servizi;

    public function __construct()
    {
        $this->servizi = new ArrayCollection();
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

    public function getTipo(): ?int
    {
        return $this->tipo;
    }

    public function setTipo(int $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getRazza(): ?string
    {
        return $this->razza;
    }

    public function setRazza(string $razza): self
    {
        $this->razza = $razza;

        return $this;
    }

    public function getTaglia(): ?string
    {
        return $this->taglia;
    }

    public function setTaglia(string $taglia): self
    {
        $this->taglia = $taglia;

        return $this;
    }

    public function getDataNascita(): ?\DateTimeInterface
    {
        return $this->data_nascita;
    }

    public function setDataNascita(\DateTimeInterface $data_nascita): self
    {
        $this->data_nascita = $data_nascita;

        return $this;
    }

    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function setPeso(float $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getSesso(): ?int
    {
        return $this->sesso;
    }

    public function setSesso(int $sesso): self
    {
        $this->sesso = $sesso;

        return $this;
    }

    public function getEta(): ?int
    {
        return $this->eta;
    }

    public function setEta(int $eta): self
    {
        $this->eta = $eta;

        return $this;
    }

    public function getComportamento(): ?string
    {
        return $this->comportamento;
    }

    public function setComportamento(?string $comportamento): self
    {
        $this->comportamento = $comportamento;

        return $this;
    }

    public function getIdCliente(): ?Clienti
    {
        return $this->id_cliente;
    }

    public function setIdCliente(?Clienti $id_cliente): self
    {
        $this->id_cliente = $id_cliente;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * @return Collection<int, Servizi>
     */
    public function getServizi(): Collection
    {
        return $this->servizi;
    }

    public function addServizi(Servizi $servizi): self
    {
        if (!$this->servizi->contains($servizi)) {
            $this->servizi->add($servizi);
            $servizi->addAnimali($this);
        }

        return $this;
    }

    public function removeServizi(Servizi $servizi): self
    {
        if ($this->servizi->removeElement($servizi)) {
            $servizi->removeAnimali($this);
        }

        return $this;
    }
}
