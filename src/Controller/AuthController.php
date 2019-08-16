<?php


namespace App\Controller;

use App\Lib\LibDB;
use App\Lib\LibUser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;

class AuthController extends AbstractController
{


  public function login(Request $request, LibUser $User)
  {

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


          $response = new Response();
          $response->headers->setCookie(Cookie::create('key', $key, time() + 3600));
          $response->send();


          $User->setAuth($key, $user['id']);
          return $this->redirectToRoute('home_page');
        }
        else {
          $errors = 'Incorrect password!';
        }
      }
      else {
        $errors = 'Incorrect username!';
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

  public function logout(Request $request, LibUser $User) {

    $key = $request->cookies->get('key', null);

    if ($User->checkAuth($key))
    {
      $response = new Response();
      $response->headers->clearCookie('key');
      $response->send();
      $User->logout($key);
    }

    return $this->redirectToRoute('login');
  }
}