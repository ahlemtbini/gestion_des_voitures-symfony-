<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_depart;

    /**
     * @ORM\Column(type="date")
     */
    private $date_retour;

    /**
     * @ORM\Column(type="integer")
     */
    private $km_depart;

    /**
     * @ORM\Column(type="integer")
     */
    private $km_retour;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="contrats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voiture;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="contrats")
     */
    private $Client;

    /**
         * @ORM\OneToOne(targetEntity=Facture::class, mappedBy="Contrat", cascade={"persist", "remove"})
         */
        private $Facture;
        
        public function getId(): ?int
    {
        return $this->id;
    }


    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(\DateTimeInterface $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->date_retour;
    }

    public function setDateRetour(\DateTimeInterface $date_retour): self
    {
        $this->date_retour = $date_retour;

        return $this;
    }

    public function getKmDepart(): ?int
    {
        return $this->km_depart;
    }

    public function setKmDepart(int $km_depart): self
    {
        $this->km_depart = $km_depart;

        return $this;
    }

    public function getKmRetour(): ?int
    {
        return $this->km_retour;
    }

    public function setKmRetour(int $km_retour): self
    {
        $this->km_retour = $km_retour;

        return $this;
    }

    public function getVoiture(): ?voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): self
    {
        $this->Client = $Client;

        return $this;
    }



    public function getTime()
    {
        return $this->date_retour->diff($this->date_depart)->days;
    }

    public function getFacture(): ?Facture
        {
            return $this->Facture;
        }

        public function setFacture(Facture $Facture): self
        {
            // set the owning side of the relation if necessary
            if ($Facture->getContrat() !== $this) {
                $Facture->setContrat($this);
            }

            $this->Facture = $Facture;

            return $this;
        }


}
