<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Instruktorius;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\InstruktoriaiFormType;

use Symfony\Component\HttpFoundation\Request;

class InstruktoriaiController extends AbstractController
{
    /**
     * @Route("/instruktoriai", name="app_instruktoriai")
     */
    public function index()
    {
        $instruktoriai = $this->getDoctrine()
            ->getRepository(Instruktorius::class)
            ->findAll();
        return $this->render('instruktoriai/instruktoriai.html.twig', [
            'instruktoriai' => $instruktoriai,
        ]);
    }

    /**
     * @Route("/instruktoriai/prideti", name="app_instruktoriaiPrideti")
     */
    public function add(Request $request)
    {
        $form = $this->createForm(InstruktoriaiFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $instruktorius = $form->getData();

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($instruktorius);
             $entityManager->flush();

             $this->addFlash('success', 'Instruktorius pridėtas');
             return $this->redirectToRoute('app_instruktoriai');
        }

        return $this->render('instruktoriai/insforma.html.twig', [
            'purpose' => 'Pridėti',
            'object' => 'instruktorių',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/instruktoriai/redaguoti/{insId}", name="app_instruktoriaiRedaguoti")
     */
    public function edit($insId, Request $request)
    {
        $instruktorius = $this->getDoctrine()->getRepository(Instruktorius::class)->find($insId);
        $form = $this->createForm(InstruktoriaiFormType::class, $instruktorius);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $instruktorius = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($instruktorius);
            $entityManager->flush();

            $this->addFlash('success', 'Instruktorius paredaguotas');
            return $this->redirectToRoute('app_instruktoriai');
        }

        return $this->render('instruktoriai/insforma.html.twig', [
            'purpose' => 'Redaguoti',
            'object' => 'instruktorių',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/instruktoriai/istrinti/{insId}", name="app_instruktoriaiIstrinti")
     */
    public function delete($insId)
    {

        $instruktorius = $this->getDoctrine()->getRepository(Instruktorius::class)->find($insId);

        if ($instruktorius != null)
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($instruktorius);
            $entityManager->flush();

            $this->addFlash('success', 'Instruktorius ištrintas');
            return $this->redirectToRoute('app_instruktoriai');
        }

        return $this->render('instruktoriai/instruktoriai.html.twig', [

        ]);
    }

    /**
     * @Route("/instruktoriai/profilis/{insId}", name="app_instruktoriaiProfilis")
     */
    public function profile($insId)
    {
        $instruktorius = $this->getDoctrine()->getRepository(Instruktorius::class)->find($insId);

        return $this->render('instruktoriai/profilis.html.twig', [
            'instr' => $instruktorius,
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
