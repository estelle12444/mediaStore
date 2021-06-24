<?php

namespace App\Entity;

use App\Repository\PersonnalisationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonnalisationRepository::class)
 */
class Personnalisation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero_whatsapp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_de_projet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele_photo;

    /**
     * @ORM\Column(type="text")
     */
    private $messages;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at_messages;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNumeroWhatsapp(): ?string
    {
        return $this->numero_whatsapp;
    }

    public function setNumeroWhatsapp(string $numero_whatsapp): self
    {
        $this->numero_whatsapp = $numero_whatsapp;

        return $this;
    }

    public function getTypeDeProjet(): ?string
    {
        return $this->type_de_projet;
    }

    public function setTypeDeProjet(string $type_de_projet): self
    {
        $this->type_de_projet = $type_de_projet;

        return $this;
    }

    public function getModelePhoto(): ?string
    {
        return $this->modele_photo;
    }

    public function setModelePhoto(string $modele_photo): self
    {
        $this->modele_photo = $modele_photo;

        return $this;
    }

    public function getMessages(): ?string
    {
        return $this->messages;
    }

    public function setMessages(string $messages): self
    {
        $this->messages = $messages;

        return $this;
    }

    public function getCreatedAtMessages(): ?\DateTimeInterface
    {
        return $this->created_at_messages;
    }

    public function setCreatedAtMessages(\DateTimeInterface $created_at_messages): self
    {
        $this->created_at_messages = $created_at_messages;

        return $this;
    }
}
