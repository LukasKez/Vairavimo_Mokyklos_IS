<?php

namespace App\Controller;

use App\Entity\TransportoPriemone;
use App\Entity\Filialas;
use App\Entity\PavaruDeze;
use App\Entity\TransportoPriemonesBusena;
use App\Entity\Marke;
use App\Entity\Modelis;

use App\Form\AutomobiliaiType;
use App\Form\KeistiFilialaFormType;
use App\Form\ModelisFormType;
use App\Form\PavaruDezesFormType;

use App\Form\AutomobilioBusenosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AutomobiliaiController extends AbstractController
{
    /**
     * @Route("/automobiliai", name="app_automobiliai")
     */
    public function index()
    {
      $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
		    $transportoPriemones = $this->getDoctrine()->getRepository(TransportoPriemone::class)->findAll();

        return $this->render('automobiliai/automobiliai.html.twig',
        array(
          'transporto_priemones' => $transportoPriemones,

      ));
    }

    /**
     * @Route("/automobiliai/prideti", name="app_automobiliaiPrideti")
     */
    public function add(Request $request)
    {
      $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $modeliai = $this->getDoctrine()->getRepository(Modelis::class)->findAll();

          $form = $this->createForm(AutomobiliaiType::class);
          $request = Request::createFromGlobals();
          $rez = $request->get('automobiliai');

            if (!empty($request->get('patvirtinti')))
            {
              var_dump($rez);
              $entityManager = $this->getDoctrine()->getManager();
              $pagaminimo_metai = (int)$rez['pagaminimo_metai'];
              $busena = (int)$rez['busena'];
              $automobilio_modelis = (int)$rez['modelis'];
              $pavaru_deze = (int)$rez['pavaru_deze'];
              $er = '';

              if($automobilio_modelis==0 || empty($rez['valstybiniai_nr']) ||
               $pagaminimo_metai == 0 || $busena == 0 || $pavaru_deze == 0 ||
               empty($rez['kebulas']) || empty($rez['kategorija']))
               {
                  $klaida = "Neteisingai užpildyti laukeliai";
               }

               $automobilio_modelis = $this->getDoctrine()->getRepository(Modelis::class)->findOneBy(['id' => $automobilio_modelis]);
               $busena = $this->getDoctrine()->getRepository(TransportoPriemonesBusena::class)->findOneBy(['id' => $busena]);
               $pavaru_deze = $this->getDoctrine()->getRepository(PavaruDeze::class)->findOneBy(['id' => $pavaru_deze]);
               $filialas = $this->getDoctrine()->getRepository(Filialas::class)->findOneBy(['id' => (int)$rez['filialas']]);
               
               if($er == '')
               {
                  $automobilis = new TransportoPriemone();
                  $automobilis->setModelis($automobilio_modelis);
                  $automobilis->setValstybiniaiNr($rez['valstybiniai_nr']);
                  $automobilis->setPagaminimoMetai($pagaminimo_metai);
                  $automobilis->setTransportoPriemonesBusena($busena);
                  $automobilis->setPavaruDeze($pavaru_deze);
                  $automobilis->setFilialas($filialas);

                  $automobilis->setIlguma(floatval($rez['ilguma']));
                  $automobilis->setPlokstuma(floatval($rez['plokstuma']));

                  $automobilis->setKebulas($rez['kebulas']);
                  $automobilis->setKategorija($rez['kategorija']);

                  $entityManager->persist($automobilis);

                  $entityManager->flush();
                  $this->addFlash('success', 'Automobilis pridėtas');
                  return $this->redirectToRoute('app_automobiliai');
                }
                else
                {
                  $this->addFlash('warning', $er);
                }
            }

        return $this->render('automobiliai/prideti.html.twig', [
          'purpose' => 'Pridėti',
          'form' => $form->createView(),
          'modeliai' => $modeliai
      ]);

    }

    /**
     * @Route("/automobiliai/keistiBusena/{id}", name="app_automobiliaiBusena")
     */
    public function condition($id, Request $request)
    {
        $this->denyAccessUnlessGranted(['ROLE_INSTRUKTORIUS', 'ROLE_ADMIN']);
        $form = $this->createForm(AutomobilioBusenosType::class);
        $form->handleRequest($request);

        $entityManager = $this->getDoctrine()->getManager();
        $automobilis = $entityManager->getRepository(TransportoPriemone::class)->find($id);

          if ($form->isSubmitted() && $form->isValid())
          {
              $busena = $request->get('automobilio_busenos')['pavadinimas'];
              $busena1 = $entityManager->getRepository(TransportoPriemonesBusena::class)->find($busena);
              if($busena == '' || $busena1 == null)
              {
                $this->addFlash('danger', 'Pasirinkta netinkama automobilio būsena');
              }
              else
              {
              $automobilis->setTransportoPriemonesBusena($busena1);
              $entityManager->persist($automobilis);
              $entityManager->flush();
              $this->addFlash('success', 'Automobilio būsena pakeista');
               return $this->redirectToRoute('app_automobiliai');
             }

          }

          return $this->render('automobiliai/keistiBusena.html.twig', [
            'purpose' => 'Pridėti',
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/automobiliai/keistiFiliala/{id}", name="app_automobiliaiFilialai")
     */
    public function changeBranch($id, Request $request)
    {
      $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(KeistiFilialaFormType::class);
        $entityManager = $this->getDoctrine()->getManager();
        $filialoID = (int)$request->get("keisti_filiala_form")['pavadinimas'];
        $filialas = $entityManager->getRepository(TransportoPriemone::class)->find($id);


        if (!empty($request->get('keistiFiliala')))
        {
          $fil = $entityManager->getRepository(Filialas::class)->find($filialoID);
          if($fil != null)
          {
              $automobilis = $entityManager->getRepository(TransportoPriemone::class)->find($id);
              $filialas = $entityManager->getRepository(Filialas::class)->find($filialoID);
              $automobilis->setFilialas($filialas);
              $entityManager->flush();
              $this->addFlash('success', 'Automobiliui pakeistas filialas');
              return $this->redirectToRoute('app_automobiliai');
          }
          else
          {
              $this->addFlash('danger', 'Pasirinktas netinkamas filialas');
          }
        }

          return $this->render('automobiliai/keistiFiliala.html.twig', [
            'purpose' => 'Keisti',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/automobiliai/vieta/{id}", name="app_automobiliaiVieta")
     */
    public function auto_position($id)
    {
      $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $automobilis = $this->getDoctrine()->getRepository(TransportoPriemone::class)->find($id);
        return $this->render('automobiliai/vieta.html.twig', [
        'purpose' => 'Automobilio vieta',
        'automobilis' => $automobilis
        ]);
    }

    /**
     * @Route("/automobiliai/istrinti/{id}", name="app_automobiliaiIstrinti")
     */
    public function delete($id)
    {
      $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $a = $this->getDoctrine()->getRepository(TransportoPriemone::class)->find($id);
        if ($a != null)
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($a);
            $entityManager->flush();
            $this->addFlash('success', 'Automobilis ištrintas');
            return $this->redirectToRoute('app_automobiliai');
        }
        return $this->render('automobiliai/automobiliai.html.twig', [
        ]);
    }

}
