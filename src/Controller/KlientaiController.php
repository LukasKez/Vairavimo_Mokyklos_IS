<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Klientas;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;

class KlientaiController extends AbstractController
{
    /**
     * @Route("/klientai", name="app_klientai")
     */
    public function index()
    {

        $klientai = $this->getDoctrine()
            ->getRepository(Klientas::class)
            ->findAll();
        return $this->render('klientai/klientai.html.twig', [
            'klientai' => $klientai,
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
         * @Route("/klientai/istrinti/{id}", name="app_klientaiIstrinti")
         */
        public function delete($id)
        {
            $klientai = $this->getDoctrine()
                ->getRepository(Klientas::class)
                ->findAll();
            $klientas = $this->getDoctrine()->getRepository(Klientas::class)->find($id);

            if ($klientas != null)
            {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($klientas);
                $entityManager->flush();

                $this->addFlash('success', 'Klientas ištrintas');
                return $this->redirectToRoute('app_klientai');
            }

            return $this->render('klientai/klientai.html.twig', [
                'klientai' => $klientai,
            ]);

        }

        /**
         * @Route("/klientai/profilis/{klientasID}", name="app_klientaiProfilis")
         */
        public function profile($klientasID)
        {

            $klientai = $this->getDoctrine()
                ->getRepository(Klientas::class)
                ->find($klientasID);
            return $this->render('klientai/perziuretiprof.html.twig', [
                'klientai' => $klientai,
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
         * @Route("/klientai/redaguoti/{klientasID}", name="app_klientaiRedaguoti")
         */
    public function edit($klientasID, Request $request, EntityManagerInterface $entityManager)
    {
        $klientas = $this->getDoctrine()
            ->getRepository(Klientas::class)
            ->find($klientasID);


        $klientas->setVardas($request->request->get('vardas'));
        $klientas->setPavarde($request->request->get('pavarde'));
        $klientas->setTelefonoNumeris($request->request->get('telefono_numeris'));
        $klientas->setAsmensKodas($request->request->get('asmens_kodas'));
        $date = new \DateTime($request->get('gimimo_metai'));
        $klientas->GimimoMetai($date);


        $entityManager->flush();
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
