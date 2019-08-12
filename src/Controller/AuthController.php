<?php


namespace App\Controller;

use App\Lib\LibDB;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthController extends AbstractController
{

  /**
   * @Route("/login", name="login")
   */
  public function index(LibDB $libDB)
  {
    $username = '';
    $password = '';

//    $this->get('svc_db');

    // $this->container->get('');

    // $this->getParameter('param1');


    $libDB->multiply(2);

    return $this->render(
        'auth/login.html.twig',
        [
            'username' => $username,
            'password' => $password
        ]
    );
  }

  /**
   * @Route("/hello/{name}")
   */
  public function hello($name)
  {
    return $this->render(
        'blog/hello.html.twig',
        [
            'name' => $name
        ]
    );
  }
}