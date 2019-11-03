<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class EgzaminaiController extends AbstractController
{
    /**
     * @Route("/egzaminai", name="app_egzaminai")
     */
    public function index()
    {
        return $this->render('egzaminai/egzaminai.html.twig', [

        ]);
    }

    /**
     * @Route("/egzaminai-admin", name="app_egzaminai_admin")
     */
    public function indexAdmin()
    {
        return $this->render('egzaminai/egzaminai_admin.html.twig', [

        ]);
    }

    /**
     * @Route("/egzaminai/itraukti", name="app_itrauktiEgzamina")
     */
    public function add()
    {
        return $this->render('egzaminai/itraukti_egzamina.html.twig', [

        ]);
    }

    /**
     * @Route("/egzaminai/redaguoti", name="app_redaguotiEgzamina")
     */
    public function update()
    {
        return $this->render('egzaminai/redaguoti_egzamina.html.twig', [

        ]);
    }

    /**
     * @Route("/egzaminai/siusti-laiska", name="app_siustiLaiska")
     */
    public function sendEmail()
    {
        return $this->render('egzaminai/siusti_laiska.html.twig', [

        ]);
    }

    /**
     * @Route("/taisykles", name="app_perziuretiTaisykles")
     */
    public function rules()
    {
        return $this->render('/egzaminai/taisykles.html.twig', [

        ]);
    }

    /**
     * @Route("/egzaminai/vidurkis", name="app_perziuretiVidurki")
     */
    public function average()
    {
        return $this->render('egzaminai/vidurkis.html.twig', [

        ]);
    }

    /**
     * @Route("/egzaminai/rezultatai", name="app_perziuretiRezultatus")
     */
    public function results()
    {
        return $this->render('egzaminai/rezultatai.html.twig', [

        ]);
    }
}
