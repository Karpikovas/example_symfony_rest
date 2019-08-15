<?php

namespace App\Controller;

use App\Lib\LibItem;
use App\Lib\LibUser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{

  public function index(LibItem $Item, LibUser $User)
  {
    if (!$User->checkAuth())
    {
      return $this->redirectToRoute('login');
    }

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
}
