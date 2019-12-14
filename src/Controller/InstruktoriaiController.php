<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Instruktorius;
use App\Entity\InstruktoriausTvarkarastis;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\DriverManager;
use App\Form\InstruktoriaiFormType;
use App\Form\InstruktoriaiRedaguotiFormType;
use App\Form\InstruktoriausTvarkarastisFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Naudotojas;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InstruktoriaiController extends AbstractController
{
    /**
     * @Route("/instruktoriai", name="app_instruktoriai")
     */
    public function index()
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $naudotojas = $this->getUser();

        if($naudotojas->getRoles()[0] == 'ROLE_KLIENTAS' || 
            $naudotojas->getRoles()[0] == 'ROLE_ADMIN'){
            
            $instruktoriai = $this->getDoctrine()
            ->getRepository(Instruktorius::class)
            ->findAll();
        }
        else if ($naudotojas->getRoles()[0] == 'ROLE_INSTRUKTORIUS'){
            $instruktoriai = $this->getDoctrine()
            ->getRepository(Instruktorius::class)
            ->findBy(['naudotojo_id' => $naudotojas]);
        }
        return $this->render('instruktoriai/instruktoriai.html.twig', [
            'instruktoriai' => $instruktoriai,
        ]);
    }

    /**
     * @Route("/instruktoriai/prideti", name="app_instruktoriaiPrideti")
     */
    public function add(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(InstruktoriaiFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            
            $naudotojas = $this->getDoctrine()
            ->getRepository(Naudotojas::class)
            ->findOneBy(['email' => $data['el_pastas']]);
            if($naudotojas != null){
                return $this->render('instruktoriai/insforma.html.twig', [
                    'purpose' => 'Pridėti',
                    'object' => 'instruktorių',
                    'form' => $form->createView(),
                    'error' => 'Toks el. pašto adresas jau egzistuoja.'
                ]);
            }
            $naudotojas = new Naudotojas();
            $naudotojas->setEmail($data['el_pastas']);
            $role[] = 'ROLE_INSTRUKTORIUS';
            $naudotojas->setRoles($role);
            $naudotojas->setPassword($passwordEncoder->encodePassword(
                             $naudotojas,
                             $data['slaptazodis']
                         ));
            $instruktorius = new Instruktorius();
            $instruktorius->setAsmensKodas($data['asmens_kodas']);
            $instruktorius->setVardas($data['vardas']);
            $instruktorius->setPavarde($data['pavarde']);
            $instruktorius->setGimimoData($data['gimimo_data']);
            $instruktorius->setVairavimoStazasMetais($data['vairavimo_stazas_metais']);
            $instruktorius->setTelefonoNumeris($data['telefono_numeris']);
            $instruktorius->setFilialas($data['filialas']);
            $instruktorius->setNaudotojoId($naudotojas);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($naudotojas);
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
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $instruktorius = $this->getDoctrine()->getRepository(Instruktorius::class)->find($insId);
        $form = $this->createForm(InstruktoriaiRedaguotiFormType::class, $instruktorius);
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
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $instruktorius = $this->getDoctrine()->getRepository(Instruktorius::class)->find($insId);

        $entityManager = $this->getDoctrine()->getManager();
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql = "SELECT pavadinimas FROM filialas WHERE id = (select instruktorius.filialo_id from instruktorius where instruktorius.id = '$insId')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $this->render('instruktoriai/profilis.html.twig', [
            'instr' => $instruktorius,
            'filialas' => $stmt->fetch()
        ]);
    }

    /**
     * @Route("/instruktoriai/tvarkarastis/{insId}", name="app_instruktoriaiTvarkarastis")
     */
    public function tvarkarastis($insId)
    {
       $this->denyAccessUnlessGranted('ROLE_INSTRUKTORIUS');

       $entityManager = $this->getDoctrine()->getManager();

       $conn = $this->getDoctrine()->getManager()->getConnection();

       $sql = "SELECT * FROM instruktoriaus_tvarkarastis WHERE instruktorius = '$insId'";
       
       $stmt = $conn->prepare($sql);
       $stmt->execute();


        return $this->render('instruktoriai/tvarkarastis.html.twig', [
            'tvarks' => $stmt->fetchAll()
        ]);
    }

    /**
     * @Route("/instruktoriai/tvarkarastis/redaguoti/{tvarkId}", name="app_instruktoriaiRedaguotiTvarkarasti")
     */
    public function tvarkarastisRedaguoti($tvarkId, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_INSTRUKTORIUS');
        $tvarkarastis = $this->getDoctrine()->getRepository(Instruktorius::class)->find($tvarkId);

        $form = $this->createForm(InstruktoriausTvarkarastisFormType::class, $tvarkarastis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $tvarkarastis = $form->getData();

           $entityManager1 = $this->getDoctrine()->getManager();
           $entityManager1->persist($tvarkarastis);
           $entityManager1->flush();

            $this->addFlash('success', 'Tvarkaraštis paredaguotas');
            return $this->redirectToRoute('app_instruktoriai');
        }

        return $this->render('instruktoriai/tvarkarastis-redaguoti.html.twig', [
            'purpose' => 'Redaguoti',
            'object' => 'tvarkaraštį',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/instruktoriai/{insId}/alga", name="app_instruktoriaiAlga")
     */
    public function skaiciuotiAlga($insId)
    {
        $this->denyAccessUnlessGranted('ROLE_INSTRUKTORIUS');
        if (empty($_GET)) {
            // no data passed by get
        } else {
            $month = $_GET['menuo'];
            $menuo = $month ;
            $entityManager = $this->getDoctrine()->getManager();

            $conn = $this->getDoctrine()->getManager()->getConnection();
      
            $sql = "SELECT SUM(HOUR(TIMEDIFF(pradzia, pabaiga))) as laikas FROM instruktoriaus_tvarkarastis WHERE instruktorius = '$insId' AND MONTH(pradzia) = MONTH('$menuo')";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $row = $stmt->fetch();
            $alga = $row['laikas'] * 15;
            return $this->render('instruktoriai/algos-skaiciavimas.html.twig', [
                'menuo' => $month,
                'laikas' => $row['laikas'],
                'alga' => $alga
            ]);
        }
      

        return $this->render('instruktoriai/algos-skaiciavimas.html.twig', [
                'menuo' => "pasirinktą",
                'laikas' => 0,
                'alga' => 0
        ]);
    }

}
