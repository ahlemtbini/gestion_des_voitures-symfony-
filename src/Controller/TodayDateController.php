<?php
// src/Controller/TodayDateController.php
namespace App\Controller; //Tous les controleurs sont définis dans un namespace App\Controller

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; // « importer la classe Response, que le contrôleur doit renvoyer.

class TodayDateController
{
  /**
       * @Route("/today/date", name="today_date")
       */
    public function date()
    {
        $date = date("d/m/Y");

        return new Response(
            '<html><body>Today is: '.$date.'</body></html>'
        ); //Le contrôleur crée et renvoie un objet Response.
     }
}
 ?>
