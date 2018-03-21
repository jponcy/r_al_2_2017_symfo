<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HelloController extends Controller
{

    /**
     * @Route(path = "/hello")
     *
     * @return Response
     */
    public function helloAction(Request $request)
    {
        $name = $request->query->get('name', 'world');

        return $this->render('Hello/hello.html.twig', [
            'name' => $name
        ]);
    }
}
