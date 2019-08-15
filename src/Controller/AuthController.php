<?php


namespace App\Controller;

use App\Lib\LibDB;
use App\Lib\LibUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthController extends AbstractController
{


  public function login(Request $request, LibUser $User)
  {

//    if ($User->checkAuth())
//    {
//      return $this->redirectToRoute('home_page');
//    }
    $errors = null;
    $username = $request->request->get('username', null);
    $password = $request->request->get('password', null);
    $submit = $request->request->get('submit', false);

    if ($submit)
    {
      $user = $User->checkUsernameExists($username);

      if ($user){
        if ($User->checkPassword($user, $password)){
          $bytes = random_bytes(25);
          $key = bin2hex($bytes);

          $request->cookies->set('key', $key);
          
        }
      }


        //$request->cookies->set(....);

        return $this->redirectToRoute('home_page');
      } else {
        $errors = 'Incorrect username or password!';
      }
    }

    return $this->render(
        'auth/login.html.twig',
        [
            'errors' => $errors,
           'username' => $username,
            'password' => $password
        ]
    );
  }

  public function logout(LibUser $User) {
    if (!$User->checkAuth())
    {
      return $this->redirectToRoute('login');
    }

    $User->logout();
    return $this->redirectToRoute('login');
  }
}