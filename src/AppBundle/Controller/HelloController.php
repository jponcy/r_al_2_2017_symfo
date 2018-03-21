<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HelloController implements ContainerAwareInterface
{

    private $container;

    /**
     * @Route(path = "/hello", name = "coucou")
     *
     * @return void
     */
    public function helloAction()
    {
        $name = $_POST['name'] ?? 'tout le monde';

        $twig = $this->container->get('twig');
        $content = $twig->render('Hello/hello.html.twig');

        $result = new Response($content, Response::HTTP_OK);
        return $result;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
