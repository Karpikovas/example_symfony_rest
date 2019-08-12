<?php


namespace App\Lib;


use Symfony\Component\DependencyInjection\Container;

class LibDB
{

  //private

  public function __construct(Container $container, Lib2 $lib2)
  {
    $pass = $container->getParameter('db_pass');

  }


}