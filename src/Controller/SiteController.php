<?php

namespace App\Controller;

use App\Lib\LibItem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
  /**
   * @Route("/", name="site")
   */
  public function index(LibItem $Item )
  {
    $header = ["ID", "Name", "SecondName", "Patr", "Birthday", "Delete"];
    $items = $Item->getItemsList();

    return $this->render(
        'site/index.html.twig',
        [
            'header' => $header,
            'items' => $items
        ]
    );
  }

  /**
   * @Route("/second/{slug<\d+>}", name="second_show")
   */
  public function second_show($slug)
  {
    return new Response(
        22222222222222
    );
  }
}
