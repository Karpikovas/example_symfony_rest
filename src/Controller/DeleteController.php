<?php


namespace App\Controller;


use App\Lib\LibItem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeleteController extends AbstractController
{


  public function ask($itemID, LibItem $Item)
  {
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

  public function process($itemID, LibItem $Item)
  {
    if (isset($_POST['delete'])) {
      $Item->deleteItemByID($itemID);
    }
    return $this->redirectToRoute('home_page');
  }

}
