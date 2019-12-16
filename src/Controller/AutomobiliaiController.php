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
		$this->denyAccessUnlessGranted('ROLE_ADMIN');
        $modeliai = $this->getDoctrine()->getRepository(Modelis::class)->findAll();
        $busenos = $this->getDoctrine()->getRepository(TransportoPriemonesBusena::class)->findAll();
        $pavaru_dezes = $this->getDoctrine()->getRepository(PavaruDeze::class)->findAll();
        $filialai = $this->getDoctrine()->getRepository(Filialas::class)->findAll();

          if (!empty($request->get('patvirtinti')))
          {
              $er = '';
              $entityManager = $this->getDoctrine()->getManager();

              $automobilis = (int) $_POST['automobilis'];
              $auto = $this->getDoctrine()->getRepository(Modelis::class)->find($automobilis);

              if($automobilis == -1 || $auto == '')
                  $er = "Reikia pasirinkti automobilį";

              $valstybiniaiNr = $_POST['vnr'];
              if($valstybiniaiNr == '' || strlen($valstybiniaiNr) != 7)
                  $er = "Valstybinių numerių ilgis turi būti sudarytas iš 7 simbolių: pvz AAA 000";

              $metai = (int) $_POST['pagaminimo_metai'];
              if($metai > date("Y") || strlen($metai) != 4)
                  $er = "Pagaminimo metai įvesti neteisingai";

              if((int)$_POST['busena'] == '')
                      $er = "Pasirinkite būseną";

              if((int)$_POST['pavaruDeze'] == '')
                $er = "Pasirinkite pavarų dėžę";

              if((int)$_POST['busena'] == '')
                      $er = "Pasirinkite būseną";

              $kategorija = $_POST['kategorija'];
              $kebulas = $_POST['kebulas'];
              if($kebulas == '' || $kategorija == '')
                  $er = "Užpildyti ne visi laukeliai";

              $nr = $this->getDoctrine()->getRepository(TransportoPriemone::class)->findOneBy(['valstybiniai_nr' => $valstybiniaiNr]);

              if($nr)
                  $er = "Automobilis su tokiais valstybiniais numeriais jau yra";


              if($er == '')
              {
                  $naujas_automobilis = new TransportoPriemone();
                  $naujas_automobilis->setModelis($auto);
                  $naujas_automobilis->setValstybiniaiNr($valstybiniaiNr);
                  $naujas_automobilis->setPagaminimoMetai($metai);
				  
                  $busena1 = $this->getDoctrine()->getRepository(TransportoPriemonesBusena::class)->find((int)$_POST['busena']);
                  $naujas_automobilis->setTransportoPriemonesBusena($busena1);
				  
				  $deze1 = $this->getDoctrine()->getRepository(PavaruDeze::class)->find((int)$_POST['pavaruDeze']);
                  $naujas_automobilis->setPavaruDeze($deze1);

                  $naujas_automobilis->setIlguma(floatval($_POST['ilguma']));
                  $naujas_automobilis->setPlokstuma(floatval($_POST['platuma']));

                  $naujas_automobilis->setKebulas($kebulas);
                  $naujas_automobilis->setKategorija($kategorija);				
				  
				  if((int)$_POST['filialas'] != '')
				  {
					$filialas1 = $this->getDoctrine()->getRepository(Filialas::class)->find((int)$_POST['filialas']);
					$naujas_automobilis->setFilialas($filialas1);				  					  
				  }

                  $entityManager->persist($naujas_automobilis);

                  $entityManager->flush();
                    $this->addFlash('success', "Automobilis pridėtas sėkmingai");
                  return $this->redirectToRoute('app_automobiliai');
              }
              else {
                $this->addFlash('danger', $er);
              }
          }

        return $this->render('automobiliai/prideti.html.twig', [
          'purpose' => 'Pridėti',
          'modeliai' => $modeliai,
          'busenos'=>$busenos,
          'pavaru_dezes' => $pavaru_dezes,
          'filialai' => $filialai,
          'postas' => $_POST
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

        $filialoID1 = $request->get("keisti_filiala_form");
        $filialas = $entityManager->getRepository(TransportoPriemone::class)->find($id);


        if (!empty($request->get('keistiFiliala')))
        {
			$fil = null;
			if(count($filialoID1) != 1)
				$filialoID = (int)$filialoID1['pavadinimas'];				
				
			$fil = $entityManager->getRepository(Filialas::class)->find($filialoID);

			if($fil != null)
			{
				  $automobilis = $entityManager->getRepository(TransportoPriemone::class)->find($id);
				  $automobilis->setFilialas($fil);
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
