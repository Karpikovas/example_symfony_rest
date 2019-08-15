<?php


namespace App\Controller;


use App\Lib\LibItem;
use App\Lib\LibUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CreateController extends AbstractController
{
  public function create(Request $request, LibItem $Item, LibUser $User)
  {
    if (!$User->checkAuth())
    {
      return $this->redirectToRoute('login');
    }

    $errors = null;
    $name = $request->request->get('name', null);
    $secondName = $request->request->get('secondName', null);
    $patr = $request->request->get('patr', null);
    $birthday = $request->request->get('birthday', null);
    $submit = $request->request->get('submit', false);


    if ($submit)
    {
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