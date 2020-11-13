<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
  * @Route("/controller")
    */

class CurrentHourController extends AbstractController
{
    /**
	* @Route("/")
     * @Route("/current/hour/{nom}", name="current_hour")
     */
    public function index(string $nom): Response
    {
        return $this->render('current_hour/index.html.twig', [
            'controller_name' => $nom,
        ]);
    }
}
?>
