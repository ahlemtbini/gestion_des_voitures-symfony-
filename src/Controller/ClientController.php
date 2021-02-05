<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ClientType;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index(): Response
    {
      $Clients = $this->getDoctrine()->getRepository(Client::class)->findAll();
        return $this->render('client/index.html.twig', [
            'Clients' =>   $Clients,
        ]);
    }

    /**
     * @Route("/createclient", name="create_client")
     */
     public function createclient(Request $request):Response
     {
       $Client = new Client();
       $form = $this->createForm(ClientType::class,$Client);

       $form->handleRequest($request);
       if ($form->isSubmitted())
       {
         $entityManger = $this->getDoctrine()->getManager();
         $entityManger->persist($Client);
         $entityManger->flush();

            return $this->redirectToRoute('client');
       }
       return $this->render('client/ajouter.html.twig',[
         'form'=>$form->createView()
       ]);}

       /**
        * @Route("/modifierclient/{Npermis}", name="modifierclientbynpermis")
        */
       public function modifier(string $Npermis, Request $request): Response
       {
         $entityManger = $this->getDoctrine()->getManager() ;
         $Client = $this->getDoctrine()->getRepository(Client::class)->findBy($arrayName = array('N_permis' => $Npermis ));
         if(!$Client)
         {
           throw $this->createNotFoundExeption(
             'pas d agence avec le nom'.$Npermis
           );

         }
         $Client=$Client[0];
         $form = $this->createForm(ClientType::class, $Client);
         $form->handleRequest($request);

         if ($form->isSubmitted())
         {
           $entityManger = $this->getDoctrine()->getManager();
           $entityManger->persist($Client);
           $entityManger->flush();

              return $this->redirectToRoute('client');
         }
         return $this->render('client/modifier.html.twig',[
           'form'=>$form->createView()
         ]);}

         /**
          * @Route("/supprimerclient/{Npermis}", name="supprimerclientbynpermis")
          */
         public function supprimer(string $Npermis): Response
         {
           $entityManger = $this->getDoctrine()->getManager() ;
           $Clients = $this->getDoctrine()->getRepository(Client::class)->findBy($arrayName = array('N_permis' => $Npermis ));
           if(!$Clients)
           {
             throw $this->createNotFoundException(
               'pas d agence avec l'.$Npermis
             );

           }
           $entityManger->remove($Clients[0]);
           $entityManger->flush();
             return $this->redirectToRoute('client');
         }


}
