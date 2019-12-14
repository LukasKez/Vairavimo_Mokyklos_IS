<?php

namespace App\Controller;

use App\Entity\Filialas;
use App\Entity\Instruktorius;
use App\Entity\Marsrutas;
use App\Entity\Miestas;
use App\Form\FilialaiFormType;
use App\Form\MarsrutasFormType;
use App\Form\MiestasFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function add(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(FilialaiFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $filialas = $form->getData();

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($filialas);
             $entityManager->flush();

             $this->addFlash('success', 'Filialas pridėtas');
             return $this->redirectToRoute('app_filialai');
        }

        return $this->render('filialai/forma.html.twig', [
            'purpose' => 'Pridėti',
            'object' => 'filialą',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/filialai/redaguoti/{filialasID}", name="app_filialaiRedaguoti")
     */
    public function edit($filialasID, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $filialas = $this->getDoctrine()->getRepository(Filialas::class)->find($filialasID);
        $form = $this->createForm(FilialaiFormType::class, $filialas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $filialas = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($filialas);
            $entityManager->flush();

            $this->addFlash('success', 'Filialas paredaguotas');
            return $this->redirectToRoute('app_filialai');
        }

        return $this->render('filialai/forma.html.twig', [
            'purpose' => 'Redaguoti',
            'object' => 'filialą',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/filialai/istrinti/{filialasID}", name="app_filialaiIstrinti")
     */
    public function delete($filialasID)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $filialas = $this->getDoctrine()->getRepository(Filialas::class)->find($filialasID);

        if ($filialas != null)
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($filialas);
            $entityManager->flush();

            $this->addFlash('success', 'Filialas ištrintas');
            return $this->redirectToRoute('app_filialai');
        }

        return $this->render('filialai/filialai.html.twig', [

        ]);
    }

    /**
     * @Route("/filialai/{filialasID}/marsrutai/", name="app_filialaiMarsrutai")
     */
    public function routes($filialasID)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $filialas = $this->getDoctrine()->getRepository(Filialas::class)->find($filialasID);
        $marsrutai = $filialas->getMarsrutas();


        return $this->render('filialai/marsrutai.html.twig', [
            'filialas' => $filialas,
            'marsrutai' => $marsrutai,
        ]);
    }
    /**
     * @Route("/filialai/{filialasID}/marsrutai/prideti", name="app_marsrutaiPrideti")
     */
    public function routesAdd(Request $request, $filialasID)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(MarsrutasFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $filialas = $this->getDoctrine()->getRepository(Filialas::class)->find($filialasID);

            $marsrutas = $form->getData();
            $marsrutas->setFilialas($filialas);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($marsrutas);
            $entityManager->flush();

            $this->addFlash('success', 'Maršrutas pridėtas');
            return $this->redirectToRoute('app_filialaiMarsrutai', ['filialasID' => $filialas->getId()]);
        }

        return $this->render('filialai/forma.html.twig', [
            'form' => $form->createView(),
            'purpose' => 'Pridėti',
            'object' => 'maršrutą',
        ]);
    }

    /**
     * @Route("/filialai/{filialasID}/instruktoriai", name="app_filialoInstruktoriai")
     */
    public function employees($filialasID)
    {
        $instruktoriai = $this->getDoctrine()->getRepository(Instruktorius::class)->findBy(['filialas'=>$filialasID]);

        return $this->render('filialai/filialo-instruktoriai.html.twig', [
            'instruktoriai' => $instruktoriai,
        ]);
    }

    /**
     * @Route("/miestai", name="app_miestai")
     */
    public function towns()
    {
        $miestai = $this->getDoctrine()->getRepository(Miestas::class)->findAll();

        return $this->render('filialai/miestai.html.twig', [
            'miestai' => $miestai,
        ]);
    }

    /**
     * @Route("/miestai/prideti", name="app_miestaiPrideti")
     */
    public function townsAdd(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(MiestasFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $miestas = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($miestas);
            $entityManager->flush();

            $this->addFlash('success', 'Miestas pridėtas');
            return $this->redirectToRoute('app_miestai');
        }

        return $this->render('filialai/forma.html.twig', [
            'form' => $form->createView(),
            'purpose' => 'Pridėti',
            'object' => 'miestą',
        ]);
    }

    /**
     * @Route("/miestai/redaguoti/{miestasID}", name="app_miestaiRedaguoti")
     */
    public function townsEdit($miestasID, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $miestas = $this->getDoctrine()->getRepository(Miestas::class)->find($miestasID);
        $form = $this->createForm(MiestasFormType::class, $miestas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $miestas = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($miestas);
            $entityManager->flush();

            $this->addFlash('success', 'Miestas paredaguotas');
            return $this->redirectToRoute('app_miestai');
        }

        return $this->render('filialai/forma.html.twig', [
            'purpose' => 'Redaguoti',
            'object' => 'miestą',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/miestai/istrinti/{miestasID}", name="app_miestaiIstrinti")
     */
    public function townsDelete($miestasID)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $miestas = $this->getDoctrine()->getRepository(Miestas::class)->find($miestasID);

        if ($miestas != null)
        {
            $filialai = $this->getDoctrine()->getManager()->getRepository(Filialas::class)->findOneBy(['miestas' => $miestas->getId()]);

            if ($filialai == null)
            {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($miestas);
                $entityManager->flush();

                $this->addFlash('success', 'Miestas ištrintas');
            }
            else
            {
                $this->addFlash('danger', 'Mieste yra filialų, pirma pašalinkite filialus');
            }
        }
        return $this->redirectToRoute("app_miestai");
    }
}
