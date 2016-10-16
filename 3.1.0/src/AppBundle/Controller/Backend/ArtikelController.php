<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Form\ArtikelKategorieArtType;
use AppBundle\Form\ArtikelKategorieType;
use AppBundle\Form\ArtikelOrteType;
use AppBundle\Form\ShopBausteineType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class ArtikelController extends Controller
{
    /**
     * @Route("/destination", name="artikel_orte", host="%subdomain_backend%.%domain%")
     */
    public function destinationAction(Request $request)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $orte = $em->getRepository('AppBundle\Entity\ArtikelOrte')->findAll();

        return $this->render('@AppBundle/Table/artikel_orte.html.twig', array('orte' => $orte));

    }

    /**
     * @Route("/destination/erstellen", name="artikel_orte_erstellen", defaults={"aoid" = "new"}, host="%subdomain_backend%.%domain%")
     * @Route("/destination/{aoid}", defaults={"aoid" = 0}, name="artikel_orte_bearbeiten", host="%subdomain_backend%.%domain%")
     */
    public function destinationBearbeitenAction(Request $request, $aoid)
    {

        $em = $this->getDoctrine()->getEntityManager();

        if($aoid == "new") {
            $form = $this->createForm(ArtikelOrteType::class);
            $ort = null;
        } else {
            if($aoid){

                $ort = $em->getRepository('AppBundle\Entity\ArtikelOrte')->find($aoid);
                $form = $this->createForm(ArtikelOrteType::class, $ort);

            }

            if(!$ort) return $this->redirectToRoute('artikel_orte');

        }

        $form->handleRequest($request);

        if($request->isMethod('POST')){

            if($form->get('abort')->isClicked() ){
                return $this->redirectToRoute('artikel_orte');
            }
            $data = $form->getData();

            if($form->isValid() && $form->get('save')->isClicked() ){


                if($data->getAOId()){
                    $data->setAOUpdate(new \DateTime());
                    $data->setAOUpdateU($this->getUser());
                } else {
                    $data->setAOCreated(new \DateTime());
                    $data->setAOCreatedU($this->getUser());
                }
                $em->persist($data);
                $em->flush();

                if(!$ort) return $this->redirectToRoute('artikel_orte_bearbeiten', ['aoid' => $data->getAOId()]);
            } elseif($form->get('delete')->isClicked() && $form->get('delete_text')->getData() == "LÖSCHEN"){
                $em->remove($data);
                $em->flush();

                return $this->redirectToRoute('artikel_orte');
            }

        }

        return $this->render('@AppBundle/Form/artikel_orte.html.twig', array('form' => $form->createView()) );
    }

    /**
     * @Route("/destination/kategoriearten", name="kategorie_arten", host="%subdomain_backend%.%domain%")
     */
    public function kategorienArtenAction(Request $request)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $arten = $em->getRepository('AppBundle\Entity\ArtikelKategorieArt')->findAll();

        return $this->render('@AppBundle/Table/kategorie_arten.html.twig', array('arten' => $arten));

    }

    /**
     * @Route("/destination/kategoriearten/erstellen", name="kategorie_arten_erstellen", defaults={"aaid" = "new"}, host="%subdomain_backend%.%domain%")
     * @Route("/destination/kategoriearten/{aaid}", requirements={"aaid"= "\d+"}, defaults={"aaid" = 0}, name="kategorie_arten_bearbeiten", host="%subdomain_backend%.%domain%")
     */
    public function kategorieArtenBearbeitenAction(Request $request, $aaid)
    {

        $em = $this->getDoctrine()->getEntityManager();

        if($aaid == "new") {
            $form = $this->createForm(ArtikelKategorieArtType::class);
            $art = null;
        } elseif($aaid > 0){
            $art = $em->getRepository('AppBundle\Entity\ArtikelKategorieArt')->find($aaid);
            $form = $this->createForm(ArtikelKategorieArtType::class, $art);
        } else {
            return $this->redirectToRoute('kategorie_arten');
        }



        $form->handleRequest($request);

        if($request->isMethod('POST')){

            if($form->isValid()){

                $data = $form->getData();
                $em->persist($data);
                $em->flush();

                if(!$art) return $this->redirectToRoute('kategorie_arten_bearbeiten', ['aaid' => $data->getAAId()]);
            }

        }

        return $this->render('@AppBundle/Form/kategorie_arten.html.twig', array('form' => $form->createView()));

    }

    /**
     * @Route("/destination/{aoid}/kategorien", requirements={"aoid"= "\d+"}, defaults={"aoid" = 0}, name="artikel_kategorien", host="%subdomain_backend%.%domain%")
     */
    public function kategorienAction(Request $request, $aoid)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $kategorie = $em->getRepository('AppBundle\Entity\ArtikelOrte')->findAllByArt($aoid);

        return $this->render('@AppBundle/Table/artikel_kategorien.html.twig', array('orte' => $kategorie));

    }


    /**
     * @Route("/destination/{aoid}/kategorien/erstellen", name="artikel_kategorien_erstellen", defaults={"akid" = "new"}, host="%subdomain_backend%.%domain%")
     * @Route("/destination/{aoid}/kategorien/{akid}", requirements={"aoid"= "\d+", "akid" = "\d+"}, defaults={"aoid" = 0, "akid" = 0}, name="artikel_kategorien_bearbeiten", host="%subdomain_backend%.%domain%")
     */
    public function kategorienBearbeitenAction(Request $request, $aoid, $akid = null)
    {
        if(!$aoid && !$akid) return $this->redirectToRoute('artikel_orte');
        if(!$akid) return $this->redirectToRoute('artikel_kategorien', array('aoid' => $aoid));

        $em = $this->getDoctrine()->getEntityManager();

        $ort = $em->getRepository('AppBundle\Entity\ArtikelOrte')->find($aoid);
        if($akid == "new") {

            $form = $this->createForm(ArtikelKategorieType::class);
            $form->get("aKOId")->setData($ort->getAOId());
            $aoid = null;

        } elseif($akid > 0){

            $kategorie = $em->getRepository('AppBundle\Entity\ArtikelKategorie')->findAllInfos($akid);

            $form = $this->createForm(ArtikelKategorieType::class, $kategorie);

        } else {
            return $this->redirectToRoute('artikel_katetegorien');
        }

        $originalAKPoints = new ArrayCollection();
        $originalAKZeiten = new ArrayCollection();

        foreach($kategorie->getAKPoints() as $AKPoint){
            $originalAKPoints->add($AKPoint);
        }
        foreach($kategorie->getAKZeiten() as $AKZeiten){
            $originalAKZeiten->add($AKZeiten);
        }

        $form->handleRequest($request);

        if($request->isMethod('POST')){

            if($form->isValid()){

                if($form->get('abort')->isClicked()) {

                    if($kategorie->getAKOid()){
                        return $this->redirectToRoute('artikel_kategorien', ['aoid' => $kategorie->getAKOId()->getAOId() ]);
                    } else {
                        return $this->redirectToRoute('artikel_orte');
                    }
                }elseif($form->get('save')->isClicked()){
                    $data = $form->getData();

                    // Zum entfernen gelöschter Verknüpfungen
                    foreach($originalAKPoints as $AKPoint) {
                        if (false === $kategorie->getAKPoints()->contains($AKPoint)) {
                            $em->remove($AKPoint);
                        }
                    }
                    foreach($originalAKZeiten as $AKZeiten) {
                        if (false === $kategorie->getAKZeiten()->contains($AKZeiten)) {
                            $em->remove($AKZeiten);
                        }
                    }

                    // Zum entfernen gelöschter Verknüpfungen ENDE


                    // Zum hinzufügen NEUER Verknüpfungen
                    foreach($kategorie->getAKPoints() as $AKPoint) {
                        $AKPoint->setAklK($kategorie);
                        $em->persist($AKPoint);
                    }
                    foreach($kategorie->getAKZeiten() as $AKZeiten) {
                        $AKZeiten->setAAbKid($kategorie);
                        $em->persist($AKZeiten);
                    }
                    // Zum hinzufügen NEUER Verknüpfungen ENDE

                    $em->persist($data);
                    $em->flush();

                    if(!$akid) return $this->redirectToRoute('artikel_kategorie_bearbeiten', ['akid' => $data->getAKId()]);
                }
            }

        }

        return $this->render('@AppBundle/Form/artikel_kategorie.html.twig', array('form' => $form->createView()));

    }

    /**
     * @Route("/bausteine", name="shop_bausteine", host="%subdomain_backend%.%domain%")
     */
    public function bausteineAction(Request $request)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $bausteine = $em->getRepository('AppBundle\Entity\ShopBausteine')->findAll();

        return $this->render('@AppBundle/Table/shop_bausteine.html.twig', array('bausteine' => $bausteine));

    }


    /**
     * @Route("/bausteine/{hid}", name="shop_bausteine_bearbeiten", host="%subdomain_backend%.%domain%")
     */
    public function bausteinBearbeitenAction(Request $request, $hid){

        $em = $this->getDoctrine()->getManager();
        
        if($hid == "neu"){
            $baustein = null;
        } else {
            $baustein = $em->getRepository('AppBundle\Entity\ShopBausteine')->find($hid);
            
            if(!$baustein) return $this->redirectToRoute('shop_bausteine');
            
        }
        
        $form = $this->createForm(ShopBausteineType::class, $baustein);
        $form->handleRequest($request);

        if($request->isMethod('POST')){

            if($form->get('abort')->isClicked()){
                return $this->redirectToRoute('shop_bausteine');
            }

            if($form->isValid() && $form->get('save')->isClicked()){

                $data = $form->getData();

                $em->persist($data);
                $em->flush();

                if(!$baustein) return $this->redirectToRoute('shop_bausteine_bearbeiten', array('hid' => $data->getHId() ));
            }
        }

        return $this->render('@AppBundle/Form/shop_bausteine.html.twig', array('form' => $form->createView()));
    }

}
