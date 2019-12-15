<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Klientas;
use App\Entity\Naudotojas;
use App\Entity\KlientoTvarkarastis;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\KlientaiFormType;

use App\Form\LaiskoFormType;
use App\Form\PriminimoFormType;

use App\Form\KlientaiRedaguotiFormType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class KlientaiController extends AbstractController
{
    /**
     * @Route("/klientai", name="app_klientai")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $naudotojas = $this->getUser();

        if($naudotojas->getRoles()[0] == 'ROLE_INSTRUKTORIUS' || 
            $naudotojas->getRoles()[0] == 'ROLE_ADMIN'){
            
            $klientai = $this->getDoctrine()
            ->getRepository(Klientas::class)
            ->findAll();
        }
        else if ($naudotojas->getRoles()[0] == 'ROLE_KLIENTAS'){
            $klientai = $this->getDoctrine()
            ->getRepository(Klientas::class)
            ->findBy(['naudotojo_id' => $naudotojas]);
        }
        return $this->render('klientai/klientai.html.twig', [
            'klientai' => $klientai,
        ]);
    }

    /**
    * @Route ("/klientai/prideti", name="app_klientaiPrideti")
    */
    public function add(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(KlientaiFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $naudotojas = $this->getDoctrine()
            ->getRepository(Naudotojas::class)
            ->findOneBy(['email' => $data['el_pastas']]);
            if($naudotojas != null){
                return $this->render('klientai/forma.html.twig', [
                    'purpose' => 'Pridėti',
                    'object' => 'klientą',
                    'form' => $form->createView(),
                    'error' => 'Toks el. pašto adresas jau egzistuoja.'
                    ]);
            }
            $naudotojas = new Naudotojas();
            $naudotojas->setEmail($data['el_pastas']);
            $role[] = 'ROLE_KLIENTAS';
            $naudotojas->setRoles($role);
            $naudotojas->setPassword($passwordEncoder->encodePassword(
                             $naudotojas,
                             $data['slaptazodis']
                         ));
            $klientas = new Klientas();
            $klientas->setAsmensKodas($data['asmens_kodas']);
            $klientas->setVardas($data['vardas']);
            $klientas->setPavarde($data['pavarde']);
            $klientas->setGimimoMetai($data['gimimo_metai']);
            $klientas->setTelefonoNumeris($data['telefono_numeris']);
            $klientas->setNaudotojoId($naudotojas);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($naudotojas);
            $entityManager->persist($klientas);
            $entityManager->flush();

            $this->addFlash('success', 'Klientas pridėtas');
            return $this->redirectToRoute('app_klientai');
        }
        return $this->render('klientai/forma.html.twig', [
                'purpose' => 'Pridėti',
                'object' => 'klientą',
                'form' => $form->createView(),
                ]);
    }



    /**
         * @Route("/klientai/istrinti/{id}", name="app_klientaiIstrinti")
         */
        public function delete($id)
        {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
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
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            
            $klientas = $this->getDoctrine()->getRepository(Klientas::class)->findOneBy(['id' => $klientasID]);
            
            return $this->render('klientai/perziuretiprof.html.twig', [
                'klientas' => $klientas,
            ]);
        }



        /**
         * @Route("/klientai/redaguoti/{klientasID}", name="app_klientaiRedaguoti")
         */
    public function edit($klientasID, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_KLIENTAS');
        $klientas = $this->getDoctrine()
            ->getRepository(Klientas::class)
            ->find($klientasID);
            $form = $this->createForm(KlientaiRedaguotiFormType::class, $klientas);
                    $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid())
                {
                    $klientas = $form->getData();

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($klientas);
                    $entityManager->flush();

                    $this->addFlash('success', 'Profilis paredaguotas');
                    return $this->redirectToRoute('app_klientaiProfilis', ['klientasID' => $klientasID]);
                }

                return $this->render('klientai/forma.html.twig', [
                    'purpose' => 'Redaguoti',
                    'object' => 'klientą',
                    'form' => $form->createView(),
                ]);
            }

        /**
         * @Route("/klientai/tvarkarastis", name="app_klientaiTvarkarastis")
         */
        public function tvarkarastis()
        {
            $naudotojas = $this->getUser();
            $naudotojas = $this->getDoctrine()->getRepository(Klientas::class)->findOneBy(['naudotojo_id' => $naudotojas]);
            $naudotojas = $naudotojas->getId();
            $entityManager = $this->getDoctrine()->getManager();


            $klientai = $this->getDoctrine()
                        ->getRepository(Klientas::class)
                        ->findAll();

            $conn = $this->getDoctrine()->getManager()->getConnection();

            $sql = "SELECT * FROM kliento_tvarkarastis 
                    JOIN pravaziavimas ON pravaziavimas.kliento_tvarkarastis = kliento_tvarkarastis.id
                        WHERE klientas = '$naudotojas'";
                $sql1 = "SELECT * FROM kliento_tvarkarastis 
                        JOIN kliento_tvarkarascio_egzaminas ON kliento_tvarkarastis_id = kliento_tvarkarastis.id
                        JOIN egzaminas ON kliento_tvarkarascio_egzaminas.egzaminas_id = egzaminas.id
                        JOIN egzaminu_tipai ON egzaminu_tipai.id = egzaminas.tipas
                        WHERE klientas = '$naudotojas'";
            
            $stmt = $conn->prepare($sql);
            $stmt1 = $conn->prepare($sql1);
            $stmt->execute();
            $stmt1->execute();
       

            return $this->render('klientai/perziuretitvark.html.twig', [
                'pravaziavimai' => $stmt->fetchAll(),
                'egzaminai' => $stmt1->fetchAll(),
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
        public function priminti(Request $request, \Swift_Mailer $mailer)
        {

                $form = $this->createForm(PriminimoFormType::class);
                $form->handleRequest($request);

                 if ($form->isSubmitted() && $form->isValid())
                                {
                                    $data = $form->getData();

                                    $message = (new \Swift_Message('Priminimas apie egzaminą'))
                                        ->setFrom('sentinelisko@gmail.com')
                                        ->setTo($data['Kam'])
                                        ->setBody(
                                            $this->renderView(
                                                'klientai/laisko_forma.html.twig',
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
                                return $this->render('klientai/siusti_laiska.html.twig', [
                                    'form' => $form->createView()
                           ]);
        }

        /**
                 * @Route("/klientai/primintiegz/{klientasEmail}/{egzName}/{egzDate}", name="app_klientaiPrimintiegz")
                 */
                public function primintiegz($klientasEmail,$egzName,$egzDate,Request $request, \Swift_Mailer $mailer)
                {

}

}
