<?php

namespace App\Controller;

use App\Entity\Filialas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class FilialaiController extends AbstractController
{
    /**
     * @Route("/filialai", name="app_filialai")
     */
    public function index()
    {
        $filialai = $this->getDoctrine()->getRepository(Filialas::class)->findAll();

        return $this->render('filialai/filialai.html.twig', [
        'filialai' => $filialai
        ]);
    }

    /**
     * @Route("/filialai/prideti", name="app_filialaiPrideti")
     */
    public function add()
    {
        return $this->render('filialai/prideti.html.twig', [
        'purpose' => 'Prideti'
        ]);
    }

    /**
     * @Route("/filialai/redaguoti", name="app_filialaiRedaguoti")
     */
    public function edit()
    {
        return $this->render('filialai/prideti.html.twig', [
        'purpose' => 'Redaguoti',
        ]);
    }

    /**
     * @Route("/filialai/istrinti", name="app_filialaiIstrinti")
     */
    public function delete()
    {

        return $this->render('filialai/filialai.html.twig', [

        ]);
    }

    /**
     * @Route("/filialai/marsrutai", name="app_filialaiMarsrutai")
     */
    public function routes()
    {


        return $this->render('filialai/marsrutai.html.twig', [

        ]);
    }

    /**
     * @Route("/filialai/instruktoriai", name="app_filialoInstruktoriai")
     */
    public function employees()
    {


        return $this->render('filialai/filialo-instruktoriai.html.twig', [

        ]);
    }
}
