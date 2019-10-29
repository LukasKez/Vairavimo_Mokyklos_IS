<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FilialaiController extends AbstractController
{
    /**
     * @Route("/filialai", name="filialai")
     */
    public function index()
    {
        return $this->render('filialai/index.html.twig', [
            'controller_name' => 'FilialaiController',
        ]);
    }
}
