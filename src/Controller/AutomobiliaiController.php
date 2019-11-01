<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AutomobiliaiController extends AbstractController
{
    public function index()
    {
        return $this->render('automobiliai/automobiliai.html.twig', [

        ]);
    }

    /**
     * @Route("/automobiliai/prideti", name="app_automobiliaiPrideti")
     */
    public function add()
    {
        return $this->render('automobiliai/prideti.html.twig', [
        'purpose' => 'Prideti'
        ]);
    }

    /**
     * @Route("/automobiliai/keistiBusena", name="app_automobiliaiBusena")
     */
    public function condition()
    {
        return $this->render('automobiliai/keistiBusena.html.twig', [
        'purpose' => 'Keisti busena',
        ]);
    }
	
	    /**
     * @Route("/automobiliai/keistiFiliala", name="app_automobiliaiFilialai")
     */
    public function changeBranch()
    {
        return $this->render('automobiliai/keistiFiliala.html.twig', [
        'purpose' => 'Keisti filiala',
        ]);
    }
	
	    /**
     * @Route("/automobiliai/vieta", name="app_automobiliaiVieta")
     */
    public function changeCondition()
    {
        return $this->render('automobiliai/vieta.html.twig', [
        'purpose' => 'Automobilio vieta',
        ]);
    }
}
