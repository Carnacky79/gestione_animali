<?php

namespace App\Entity;

use App\Repository\ServiziRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiziRepository::class)]
class Servizi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descrizione = null;

    #[ORM\Column]
    private ?float $prezzo = null;

    #[ORM\ManyToMany(targetEntity: Animali::class, inversedBy: 'servizi')]
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

    public function getDescrizione(): ?string
    {
        return $this->descrizione;
    }

    public function setDescrizione(string $descrizione): self
    {
        $this->descrizione = $descrizione;

        return $this;
    }

    public function getPrezzo(): ?float
    {
        return $this->prezzo;
    }

    public function setPrezzo(float $prezzo): self
    {
        $this->prezzo = $prezzo;

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
        }

        return $this;
    }

    public function removeAnimali(Animali $animali): self
    {
        $this->animali->removeElement($animali);

        return $this;
    }
}
