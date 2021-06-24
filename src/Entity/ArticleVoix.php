<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Entity\File;
use App\Repository\ArticleVoixRepository;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=ArticleVoixRepository::class)
 * @ORM\Table(name="article_voix",indexes={@ORM\Index(columns={"titre","description"},flags={"fulltext"})})
 * @Vich\Uploadable()
 */
class ArticleVoix
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $voixName;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="property_voixOff",fileNameProperty="voixName")
     */
    private $voixFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_de_creation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="integer")
     */
    private $auteur;

    public function __construct()
    {
        
        $this->date_de_creation= new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateDeCreation(): ?\DateTimeInterface
    {
        return $this->date_de_creation;
    }

    public function setDateDeCreation(\DateTimeInterface $date_de_creation): self
    {
        $this->date_de_creation = $date_de_creation;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getAuteur(): ?int
    {
        return $this->auteur;
    }

    public function setAuteur(int $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return null|string
     */

    public function getVoixName(): ?string
    {
        return $this->voixName;
    }

    /**
     * @param null|string $voixName
     * @return ArticleVoix
     */
    public function setVoixName(?string $voixName): self
    {
        $this->voixName = $voixName;

        return $this;
    }

    /**
     * @return null|File
     */

    public function getVoixFile(): ?File
    {
        return $this->voixFile;
    }

    /**
     * @param null|File $voixFile
     * @return ArticleImg
     */
    public function setVoixFile(File $voixName = null)
    {
        $this->voixFile = $voixName ;
        if($voixName ){
            $this->date_de_creation =new \DateTime('now');
        }

        return $this;
    }
}
