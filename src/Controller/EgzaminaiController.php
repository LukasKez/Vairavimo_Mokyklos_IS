<?php

namespace App\Controller;

use App\Entity\InstruktoriausTvarkarastis;
use App\Entity\KlientoTvarkarastis;
use App\Form\EgzaminasFormType;
use App\Form\EgzaminoItraukimoFormType;
use App\Form\LaiskoFormType;
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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $naudotojas = $this->getUser();
        $egzaminai = array();
        $visiEgzaminai = $this->getDoctrine()
            ->getRepository(LaikomasEgzaminas::class)->findAll();

        if($naudotojas->getRoles()[0] == 'ROLE_INSTRUKTORIUS'){
            foreach($visiEgzaminai as $egzaminas){
                if($egzaminas->getInstruktorius()->getNaudotojoId()->getId() == $naudotojas->getId()){
                    array_push($egzaminai, $egzaminas);
                }
            }
        }else if($naudotojas->getRoles()[0] == 'ROLE_KLIENTAS'){
            foreach($visiEgzaminai as $egzaminas){
                if($egzaminas->getKlientas()->getNaudotojoId()->getId() == $naudotojas->getId()){
                    array_push($egzaminai, $egzaminas);
                }
            }
        }
        else if($naudotojas->getRoles()[0] == 'ROLE_ADMIN'){
            $egzaminai = $this->getDoctrine()
                ->getRepository(Egzaminas::class)
                ->findAll();
        }

        return $this->render('egzaminai/egzaminai.html.twig', [
            'egzaminai' => $egzaminai
        ]);
    }

    /**
     * @Route("/egzaminai/itraukti/{slug}", name="app_itrauktiEgzamina")
     */
    public function insert(Request $request, $slug)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $egzaminas = $this->getDoctrine()->getRepository(Egzaminas::class)->find($slug);
        $form = $this->createForm(EgzaminoItraukimoFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $klientoTvarkarastis = null;
            $instruktoriausTvarkarastis = null;

            $klientoTvarkarasciai= $this->getDoctrine()
                ->getRepository(KlientoTvarkarastis::class)->findAll();//findOneBy(['pabaiga' => null]);
            $instruktoriausTvarkarasiai = $this->getDoctrine()
                ->getRepository(InstruktoriausTvarkarastis::class)->findAll();//indOneBy(['pabaiga' => null]);

            foreach ($klientoTvarkarasciai as $tvarkarastis){
                $id = $tvarkarastis->getKlientas()->getId();
                $pabaiga = $tvarkarastis->getPabaiga();
                if($data['Klientas']->getId() == $id && $pabaiga == null){
                    $klientoTvarkarastis = $tvarkarastis;
                }
            }
            foreach ($instruktoriausTvarkarasiai as $tvarkarastis){
                $id = $tvarkarastis->getInstruktorius()->getId();
                $pabaiga = $tvarkarastis->getPabaiga();
                if($data['Instruktorius']->getId() == $id && $pabaiga == null){
                    $instruktoriausTvarkarastis = $tvarkarastis;
                }
            }

            $entityManager = $this->getDoctrine()->getManager();
            $date = new \DateTime();
            $date->format('Y-m-d');
            if($klientoTvarkarastis == null){
                $klientoTvarkarastis = new KlientoTvarkarastis();
                $klientoTvarkarastis->setPradzia($date);
                $klientoTvarkarastis->setKlientas($data['Klientas']);
                $klientoTvarkarastis->setVairavimuSkaicius(0);
                $entityManager->persist($klientoTvarkarastis);
            }
            if($instruktoriausTvarkarastis == null){
                $instruktoriausTvarkarastis = new InstruktoriausTvarkarastis();
                $instruktoriausTvarkarastis->setPradzia($date);
                $instruktoriausTvarkarastis->setInstruktorius($data['Instruktorius']);
                $entityManager->persist($instruktoriausTvarkarastis);
            }
            $egzaminas->addKlientoEgzaminas($klientoTvarkarastis);
            $egzaminas->addInstruktoriausEgzaminas($instruktoriausTvarkarastis);
            $entityManager->persist($egzaminas);
            $entityManager->flush();

            $this->addFlash('success', 'Egzaminas sėkmingai įtrauktas į tvarkaraščius ');
            return $this->redirectToRoute('app_egzaminai');
        }
        return $this->render('egzaminai/itraukti_egzamina.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/egzaminai/redaguoti/{slug}", name="app_redaguotiEgzamina")
     */
    public function update(Request $request, $slug)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $egzaminas = $this->getDoctrine()->getRepository(Egzaminas::class)->find($slug);
        $form = $this->createForm(EgzaminasFormType::class, $egzaminas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $egzaminas = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($egzaminas);
            $entityManager->flush();

            $this->addFlash('success', 'Egzaminas sėkmingai redaguotas. Nepamirškite pranešti klientams apie pasikeitimus! ');
            return $this->redirectToRoute('app_egzaminai');
        }
        return $this->render('egzaminai/redaguoti_egzamina.html.twig', [
            'form' => $form->createView(),
            'egzaminas' => $egzaminas
        ]);

    }

    /**
     * @Route("/egzaminai/siusti-laiska", name="app_siustiLaiska")
     */
    public function sendEmail(Request $request, \Swift_Mailer $mailer)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(LaiskoFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $message = (new \Swift_Message('Pasikeitė egzamino duomenys'))
                ->setFrom('vairavimo-mokykla@gmail.com')
                ->setTo($data['Kam']->getEmail())
                ->setBody(
                    $this->renderView(
                        'egzaminai/laisko_forma.html.twig',
                        ['data' => $data]
                    ),
                    'text/html'
                )
            ;

            //dd($message);
            $mailer->send($message);

            $this->addFlash('success', 'Laiškas sėkmingai išsiųstas');
            return $this->redirectToRoute('app_egzaminai');
        }

        return $this->render('egzaminai/siusti_laiska.html.twig', [
            'form' => $form->createView()
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
        $this->denyAccessUnlessGranted('ROLE_KLIENTAS');
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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $egzaminas = $this->getDoctrine()
            ->getRepository(LaikomasEgzaminas::class)
            ->find($slug);
        return $this->render('egzaminai/rezultatai.html.twig', [
            'egzaminas'=>$egzaminas
        ]);
    }

}
