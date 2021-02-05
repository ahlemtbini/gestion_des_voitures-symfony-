<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contrat;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ContratType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Voiture;
use App\Entity\Facture;
use App\Form\FactureType;



class ContratController extends AbstractController
{
    /**
     * @Route("/contrat", name="contrat")
     */
    public function index(): Response
    {
      $Contrats = $this->getDoctrine()->getRepository(Contrat::class)->findAll();
        return $this->render('contrat/index.html.twig', [
            'Contrats' =>   $Contrats,
        ]);}



    /**
     * @Route("/createcontrat", name="create_contrat")
     */
    public function creatContrat(Request $request) :Response {

      $contrat = new Contrat();
          $form = $this->createForm(ContratType::class, $contrat);

           $form->handleRequest($request);

           if ($form->isSubmitted() ){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contrat);
            $entityManager->flush();

            return $this->redirectToRoute('voiture');

           }
          return $this->render('contrat/create.html.twig' , [
            'form' => $form->createView()
          ]);


        return $this->render('contrat/create.html.twig',[
            'form'=>$form->createView()]);

    }

    /**
     * @Route("/modifiercontrat/{id}", name="modifiercontratbyid")
     */
    public function modifier(string $id, Request $request): Response
    {
      $entityManger = $this->getDoctrine()->getManager() ;
      $Contrat = $this->getDoctrine()->getRepository(Contrat::class)->findBy($arrayName = array('id' => $id));
      if(!$Contrat)
      {
        throw $this->createNotFoundExeption(
          'pas de contrat avec ce id'.$id
        );

      }
      $Contrat=$Contrat[0];
      $form = $this->createForm(ContratType::class, $Contrat);
      $form->handleRequest($request);

      if ($form->isSubmitted())
      {
        $entityManger = $this->getDoctrine()->getManager();
        $entityManger->persist($Agence);
        $entityManger->flush();

           return $this->redirectToRoute('contrat');
      }
      return $this->render('contrat/modifier.html.twig',[
        'form'=>$form->createView()
      ]);}



  }
