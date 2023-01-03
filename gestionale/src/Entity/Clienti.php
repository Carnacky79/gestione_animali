<?php

namespace App\Entity;

use App\Repository\ClientiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "clienti")]
#[ORM\Entity(repositoryClass: ClientiRepository::class)]
class Clienti
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(length: 255)]
    private ?string $cognome = null;

    #[ORM\Column(length: 16, nullable: true)]
    private ?string $cf = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $telefono = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto = null;

    #[ORM\OneToMany(mappedBy: 'id_cliente', targetEntity: Animali::class)]
    private Collection $animali;

    public function __construct()
    {
        $this->animali = new ArrayCollection();
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

    public function getCognome(): ?string
    {
        return $this->cognome;
    }

    public function setCognome(string $cognome): self
    {
        $this->cognome = $cognome;

        return $this;
    }

    public function getCf(): ?string
    {
        return $this->cf;
    }

    public function setCf(?string $cf): self
    {
        $this->cf = $cf;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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
     * @return Collection<int, Animali>
     */
    public function getAnimali(): Collection
    {
        return $this->animali;
    }

    public function addAnimali(Animali $animali): self
    {
        if (!$this->animali->contains($animali)) {
            $this->animali->add($animali);
            $animali->setIdCliente($this);
        }

        return $this;
    }

    public function removeAnimali(Animali $animali): self
    {
        if ($this->animali->removeElement($animali)) {
            // set the owning side to null (unless already changed)
            if ($animali->getIdCliente() === $this) {
                $animali->setIdCliente(null);
            }
        }

        return $this;
    }
}
