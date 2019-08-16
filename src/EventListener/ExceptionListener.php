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
    $response = new Response($this->renderView('error/error.html.twig', ['error' => $exception->getCode()]));

    $event->setResponse($response);
  }
}