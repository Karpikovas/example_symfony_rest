<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SiteController extends AbstractController
{
  public function first()
  {
    return new Response(
        111111
    );
  }

  /**
   * @Route("/", name="main_second")
   */
  public function index()
  {
    $name = 'Somebody';

    return $this->render(
        'site/index.html.twig',
        ['name' => $name]
    );

//    return new Response(
//        '<html><body>Lucky number: '.$_SERVER["SERVER_SOFTWARE"].'</body></html>'
//    );

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