<?php


namespace App\Controller;


use App\Lib\LibItem;
use App\Lib\LibUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends AbstractController
{
  public function index(LibItem $Item, LibUser $User)
  {

    $items = $Item->getItemsList();

    $response = new Response();
    $response->headers->set('Content-Type', 'application/json', 'charset=utf-8');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $json = [
        'items' => $items
    ];
    $response->setContent(json_encode($json));

    return $response;

  }
}