<?php

namespace App\Controller;

use App\Lib\LibItem;
use App\Lib\LibUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SiteController extends AbstractController
{

  public function index(Request $request, LibItem $Item, LibUser $User)
  {
//    $key = $request->cookies->get('key', null);
//
//    if (!$User->checkAuth($key)) {
//      return $this->redirectToRoute('login');
//    }

    $header = ["ID", "Name", "SecondName", "Patr", "Birthday", "Delete"];
    $items = $Item->getItemsList();

    return $this->render(
        'site/index.html.twig',
        [
            'header' => $header,
            'items' => $items
        ]
    );

//    return $this->json([
//        'message' => 'Welcome to your new controller!',
//        'path' => 'src/Controller/UsersController.php',
//    ]);
  }
}
