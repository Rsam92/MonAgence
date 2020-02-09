<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
//use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PropertyController extends AbstractController
{

  /**
  *@Route("/biens", name="property.index")
  */
  public function index(): Response
  {
    return $this->render('property/index.html.twig', [
      'current_menu' => 'properties'
    ]);
  }




}
