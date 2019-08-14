<?php


namespace App\Controller;


use App\Lib\LibItem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeleteController extends AbstractController
{
    /**
     * @Route("/delete/{slug<\d+>}/ask", name="delete_ask")
     */
    public function index($slug, LibItem $Item)
    {
        $itemID = $slug;
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

}
