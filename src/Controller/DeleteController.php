<?php


namespace App\Controller;


use App\Lib\LibItem;
use App\Lib\LibUser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeleteController extends AbstractController
{


  public function ask($itemID, LibItem $Item, LibUser $User)
  {
    if (!$User->checkAuth())
    {
      return $this->redirectToRoute('login');
    }

    $items = $Item->getItemByID($itemID);
    $header = ["ID", "Name", "SecondName", "Patr", "Birthday"];

    return $this->render(
        'delete/index.html.twig',
        [
            'header' => $header,
            'items' => $items,
            'itemID' => $itemID
        ]
    );

  }

  public function process($itemID, LibItem $Item, LibUser $User)
  {
    if (!$User->checkAuth())
    {
      return $this->redirectToRoute('login');
    }

    if (isset($_POST['delete'])) {
      $Item->deleteItemByID($itemID);
    }
    return $this->redirectToRoute('home_page');
  }

}
