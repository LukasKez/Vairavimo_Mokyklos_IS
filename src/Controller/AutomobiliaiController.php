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
		    $transportoPriemones = $this->getDoctrine()->getRepository(TransportoPriemone::class)->AutomobilisInfo();

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
        $modeliai = $this->getDoctrine()->getRepository(Modelis::class)->findAll();

          $form = $this->createForm(AutomobiliaiType::class);
          $request = Request::createFromGlobals();
          $rez = $request->get('automobiliai');
          var_dump($rez);

            if (!empty($request->get('patvirtinti')))
            {
              $entityManager = $this->getDoctrine()->getManager();
              $pagaminimo_metai = (int)$rez['pagaminimo_metai'];
              $busena = (int)$rez['busena'];
              $automobilio_modelis = (int)$rez['Automobilis'];
              $pavaru_deze = (int)$rez['pavaru_deze'];

              $er = '';


              if($automobilio_modelis==0 || empty($rez['valstybiniai_nr']) ||
               $pagaminimo_metai == 0 || $busena == 0 || $pavaru_deze == 0 ||
               empty($rez['kebulas']) || empty($rez['kategorija']))
               {
                  $klaida = "Neteisingai užpildyti laukeliai";
               }

               if($er == '')
               {
                  $automobilis = new TransportoPriemone();
                  $automobilis->setModelis($rez['Automobilis']);
                  $automobilis->setValstybiniaiNr($rez['valstybiniai_nr']);
                  $automobilis->setPagaminimoMetai($pagaminimo_metai);
                  $automobilis->setBusena($busena);
                  $automobilis->setPavaruDeze($pavaru_deze);

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

              $automobilis->setBusena($busena);
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
              $automobilis->setFilialas($filialoID);
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
