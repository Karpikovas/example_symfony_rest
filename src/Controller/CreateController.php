<?php


namespace App\Controller;


use App\Lib\LibItem;
use http\Env\Request;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateController extends AbstractController
{
  public function create(LibItem $Item)
  {

    if (isset($_POST['submit'])) {

      $name = $_POST['name'];
      $secondName = $_POST['secondname'];
      $patr = $_POST['patr'];
      $birthday = $_POST['birthday'];

      $errors = false;
      if (!$Item->checkName($name)) {

        $errors[] = 'Error with name';
      }
      if (!$Item->checkSecondName($secondName)) {
        $errors[] = 'Error with secondname';
      }
      if (!$Item->checkPatr($patr)) {
        $errors[] = 'Error with patr';
      }
      if (!$Item->checkBirthday($birthday)) {
        $errors[] = 'Error with birthday';
      }
      if ($errors == false) {
        $Item->addItem($name, $secondName, $patr, $birthday);
        return $this->redirectToRoute('home_page');
      }
    }

    return $this->render(
        'create/index.html.twig',
        [
            'name' => $name,
            'secondName' => $secondName,
            'patr' => $patr,
            'birthday' => $birthday,
            'errors' => $errors
        ]
    );
  }
}