<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends Controller
{

    /**
     * @Route(path = "/hello", name = "coucou")
     *
     * @return void
     */
    public function helloAction()
    {
        return $this->render('Hello/hello.html.twig');
    }
}
