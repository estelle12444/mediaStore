<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleVideoRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

/**
 * @ORM\Entity(repositoryClass=ArticleVideoRepository::class)
 * @ORM\Table(name="article_video",indexes={@ORM\Index(columns={"titre","description"},flags={"fulltext"})})
 * Vich\Uploadable()
 */
class ArticleVideo
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
    private $videoName;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="property_video",fileNameProperty="videoName")
     */
    private $videoFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_de_creation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;

    /**
     * @ORM\Column(type="integer", nullable=true)
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

    public function setPrix(?string $prix): self
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

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getAuteur(): ?int
    {
        return $this->auteur;
    }

    public function setAuteur(?int $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }
    /**
     * @return null|string
     */

    public function getVideoName(): ?string
    {
        return $this->videoName;
    }

    /**
     * @param null|string $filename
     * @return ArticleImg
     */
    public function setVideoName(?string $videoName): self
    {
        $this->videoName = $videoName;

        return $this;
    }

    /**
     * @return null|File
     */

    public function getVideoFile(): ?File
    {
        return $this->videoFile;
    }

    /**
     * @param null|File $videoFile
     * @return ArticleVideo
     */
    public function setVideoFile(File $videoFile= null)
    {
        $this->videoFile = $videoFile;
        if($videoFile){
            $this->date_de_creation =new \DateTime('now');
        }

        return $this;
    }

}
