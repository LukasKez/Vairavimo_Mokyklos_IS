<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Egzaminas;
use App\Entity\EgzaminuTipai;
use App\Entity\LaikomasEgzaminas;

class EgzaminaiController extends AbstractController
{
    /**
     * @Route("/egzaminai", name="app_egzaminai")
     */
    public function index()
    {
        $egzaminai = $this->getDoctrine()
            ->getRepository(LaikomasEgzaminas::class)
            ->findAll();

        return $this->render('egzaminai/egzaminai.html.twig', [
            'egzaminai' => $egzaminai
        ]);
    }

    /**
     * @Route("/egzaminai-admin", name="app_egzaminai_admin")
     */
    public function indexAdmin()
    {
        $egzaminai = $this->getDoctrine()
            ->getRepository(Egzaminas::class)
            ->findAll();

        return $this->render('egzaminai/egzaminai_admin.html.twig', [
            'egzaminai' => $egzaminai
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
     * @Route("/egzaminai/redaguoti/{slug}", name="app_redaguotiEgzamina")
     */
    public function update($slug)
    {
        $egzaminas = $this->getDoctrine()
            ->getRepository(Egzaminas::class)
            ->find($slug);
        return $this->render('egzaminai/redaguoti_egzamina.html.twig', [
            'egzaminas' => $egzaminas
        ]);
    }

    /**
     * @Route("/egzaminai/pakeisti/{slug}", name="app_pakeistiEgzamina")
     */
    public function edit(Request $request, $slug, EntityManagerInterface $entityManager)
    {
        $egzaminas = $this->getDoctrine()
            ->getRepository(Egzaminas::class)
            ->find($slug);

        $date = new \DateTime($request->get('data'));
        $egzaminas->setData($date);
        $egzaminas->setLaikas(strval($request->request->get('laikas')));
        $egzaminas->setAdresas($request->request->get('adresas'));
        $entityManager->flush();

        return $this->render('egzaminai/redaguoti_egzamina.html.twig', [
            'egzaminas' => $egzaminas
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
        $egzaminai = $this->getDoctrine()
            ->getRepository(LaikomasEgzaminas::class)
            ->findAll();
        $suma = 0;
        $kiekis = 0;
        foreach ($egzaminai as $egzaminas){
            $suma += $egzaminas->getBalas();
            $kiekis++;
        }
        $vid = $suma / $kiekis;
        return $this->render('egzaminai/vidurkis.html.twig', [
            'vidurkis' => $vid,
            'kiekis' => $kiekis,
            'egzaminai' => $egzaminai
        ]);
    }

    /**
     * @Route("/egzaminai/rezultatai/{slug}", name="app_perziuretiRezultatus")
     */
    public function results($slug)
    {
        $egzaminas = $this->getDoctrine()
            ->getRepository(LaikomasEgzaminas::class)
            ->find($slug);
        return $this->render('egzaminai/rezultatai.html.twig', [
            'egzaminas'=>$egzaminas
        ]);
    }
}
