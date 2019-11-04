<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class InstruktoriaiController extends AbstractController
{
    /**
     * @Route("/instruktoriai", name="app_instruktoriai")
     */
    public function index()
    {
        return $this->render('instruktoriai/instruktoriai.html.twig', [

        ]);
    }

    /**
     * @Route("/instruktoriai/prideti", name="app_instruktoriaiPrideti")
     */
    public function add()
    {
        return $this->render('instruktoriai/prideti.html.twig', [
        'purpose' => 'Prideti'
        ]);
    }

    /**
     * @Route("/instruktoriai/redaguoti", name="app_instruktoriaiRedaguoti")
     */
    public function edit()
    {
        return $this->render('instruktoriai/prideti.html.twig', [
        'purpose' => 'Redaguoti',
        ]);
    }

    /**
     * @Route("/instruktoriai/istrinti", name="app_instruktoriaiIstrinti")
     */
    public function delete()
    {

        return $this->render('instruktoriai/instruktoriai.html.twig', [

        ]);
    }

    /**
     * @Route("/instruktoriai/profilis", name="app_instruktoriaiProfilis")
     */
    public function profile()
    {


        return $this->render('instruktoriai/profilis.html.twig', [

        ]);
    }

    /**
     * @Route("/instruktoriai/instr", name="app_instruktoriaiInstruktoriai")
     */
    public function salary()
    {


        return $this->render('instruktoriai/instruktoriai.html.twig', [

        ]);
    }

    /**
     * @Route("/instruktoriai/tvarkarastis", name="app_instruktoriaiTvarkarastis")
     */
    public function tvarkarastis()
    {
        return $this->render('instruktoriai/tvarkarastis.html.twig', [

        ]);
    }

    /**
     * @Route("/instruktoriai/tvarkarastis/redaguoti", name="app_instruktoriaiRedaguotiTvarkarasti")
     */
    public function tvarkarastisRedaguoti()
    {
        return $this->render('instruktoriai/tvarkarastis-redaguoti.html.twig', [

        ]);
    }

    /**
     * @Route("/instruktoriai/alga", name="app_instruktoriaiAlga")
     */
    public function skaiciuotiAlga()
    {
        return $this->render('instruktoriai/algos-skaiciavimas.html.twig', [

        ]);
    }

}
