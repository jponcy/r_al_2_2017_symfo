<?php

namespace AppBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\Response;

class HelloController implements ContainerAwareInterface
{
    /* Get container. */
    use ContainerAwareTrait;

    /**
     * @Route(path = "/hello", name = "coucou")
     *
     * @return void
     */
    public function helloAction()
    {
        $twig = $this->container->get('twig');
        $content = $twig->render('Hello/hello.html.twig');

        $result = new Response($content, Response::HTTP_OK);
        return $result;
    }
}
