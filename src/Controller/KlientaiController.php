<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class KlientaiController extends AbstractController
{
    /**
     * @Route("/klientai", name="app_klientai")
     */
    public function index()
    {
        return $this->render('klientai/klientai.html.twig', [
            'controller_name' => 'KlientaiController',
        ]);
    }

    /**
    * @Route ("/klientai/prideti", name="app_klientaiPrideti")
    */
    public function add()
    {
        return $this->render('klientai/pridetikl.html.twig', [
                'purpose' => 'Prideti'
                ]);
    }

    /**
         * @Route("/klientai/istrinti", name="app_klientaiIstrinti")
         */
        public function delete()
        {

            return $this->render('klientai/klientai.html.twig', [

            ]);
        }

        /**
         * @Route("/klientai/profilis", name="app_klientaiProfilis")
         */
        public function profile()
        {


            return $this->render('klientai/perziuretiprof.html.twig', [

            ]);
        }

        /**
         * @Route("/klientai/redaguoti", name="app_klientaiRedaguoti")
         */
            public function edit()
            {
                return $this->render('klientai/redaguotiprof.html.twig', [
                'purpose' => 'Redaguoti',
                ]);
            }

        /**
         * @Route("/klientai/tvarkarastis", name="app_klientaiTvarkarastis")
         */
        public function tvarkarastis()
        {


            return $this->render('klientai/perziuretitvark.html.twig', [

            ]);
        }

        /**
         * @Route("/klientai/progresas", name="app_klientaiProgresas")
         */
        public function progresas()
        {


            return $this->render('klientai/progresas.html.twig', [

            ]);
        }

        /**
         * @Route("/klientai/egzaminai", name="app_klientaiEgzaminai")
         */
        public function egzaminai()
        {


            return $this->render('klientai/kl_egzaminai.html.twig', [

            ]);
        }
        /**
         * @Route("/klientai/priminti", name="app_klientaiPriminti")
         */
        public function priminti()
        {


            return $this->render('klientai/priminti.html.twig', [

            ]);
        }
}
