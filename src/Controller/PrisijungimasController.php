<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class PrisijungimasController extends AbstractController
{
    /**
     * @Route("/prisijungti", name="app_prisijungimas")
     */
    public function index()
    {
        return $this->render('prisijungimas.html.twig', [

        ]);
    }
}
