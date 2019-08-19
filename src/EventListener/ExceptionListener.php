<?php


namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener extends AbstractController
{
  public function onKernelException(ExceptionEvent $event)
  {
    $exception = $event->getException();
    $errorCode = Response::HTTP_INTERNAL_SERVER_ERROR; // 500
    $errorMessage = $exception->getMessage();



    if ($exception instanceof HttpExceptionInterface) {
      $errorCode = $exception->getStatusCode();
    }

    if ($event->getRequest()->isXmlHttpRequest()) {
      $response = new Response($this->renderView('error/json', ['code' => $errorCode, 'message' => $errorMessage]));
    } else {
      $response = new Response($this->renderView('error/error.html.twig', ['code' => $errorCode, 'message' => $errorMessage]));
    }

    $response->setStatusCode($errorCode);

    $event->setResponse($response);
  }
}