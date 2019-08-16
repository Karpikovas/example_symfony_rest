<?php


namespace App\Controller;


use App\Lib\LibItem;
use App\Lib\LibUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{


  public function ask(Request $request, $itemID, LibItem $Item, LibUser $User)
  {
    $key = $request->cookies->get('key', null);

    if (!$User->checkAuth($key)) {
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

  public function process(Request $request, $itemID, LibItem $Item, LibUser $User)
  {
    $key = $request->cookies->get('key', null);

    if (!$User->checkAuth($key)) {
      return $this->redirectToRoute('login');
    }

    if (isset($_POST['delete'])) {
      $Item->deleteItemByID($itemID);
    }
    return $this->redirectToRoute('home_page');
  }

}
