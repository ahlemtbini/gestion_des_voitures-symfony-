<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_de_facture;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montant;


    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="factures")
     */
    private $Client;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $payee;

    /**
     * @ORM\OneToOne(targetEntity=Contrat::class, cascade={"persist", "remove"})
     */
    private $Contrat;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeFacture(): ?\DateTimeInterface
    {
        return $this->date_de_facture;
    }

    public function setDateDeFacture(\DateTimeInterface $date_de_facture): self
    {
        $this->date_de_facture = $date_de_facture;

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

    public function getPayee(): ?bool
    {
        return $this->payee;
    }

    public function setPayee(?bool $payee): self
    {
        $this->payee = $payee;

        return $this;
    }


    public function getMontant(): ?float
    {
      if($this->getContrat())
         return $this->getContrat()->getTime() * 100;
      return 0;
    }

    public function setMontant(?float $montant): self
    {
        $this->montant =$this->getContrat()->getTime() * 100;

        return $this;
    }

    public function getContrat(): ?Contrat
    {
        return $this->Contrat;
    }

    public function setContrat(?Contrat $Contrat): self
    {
        $this->Contrat = $Contrat;

        return $this;
    }


}
