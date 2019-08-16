<?php


namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener extends AbstractController
{
  public function onKernelException(ExceptionEvent $event)
  {
    $exception = $event->getException();
    $error = $exception->getCode();


    if ($exception instanceof HttpExceptionInterface) {
      $error = $exception->getStatusCode();
    } else {
      $error = Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    $response = new Response($this->renderView('error/error.html.twig', ['error' => $error]));
    $event->setResponse($response);
  }
}