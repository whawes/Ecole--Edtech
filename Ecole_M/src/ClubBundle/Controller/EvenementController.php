<?php

namespace ClubBundle\Controller;

use ClubBundle\Entity\Club;
use ClubBundle\Form\EvenementType;
use ClubBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class EvenementController extends Controller
{
    public function addEventAction(Request $request)
    {
        //$users = $em->getRepository(Club::class)->FindENS();
        $em = $this->getDoctrine()->getManager();
        $evenementx = $em->getRepository("ClubBundle:Evenement")->findAll();

        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($evenement);
            $em->flush();
            return $this->redirectToRoute("addEvent");
        }
        return $this->render('@Club/Evenement/add.html.twig', array(
            'form' => $form->createView(),'Evenement'=>$evenementx
        ));
    }

    public function viewAction()
    {
        return $this->render('@Club/Evenement/view.html.twig', array(
            // ...
        ));
    }

    public function updateAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository(Evenement::class)->find($id);
        $form = $this->createForm(EvenementType::class, $club);
        $form = $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('addEvent');
        }
        return $this->render('@Club/Evenement/update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $rs = $em->getRepository(Evenement::class)->find($id);
        $em->remove($rs);
        $em->flush();
        return $this->redirectToRoute('addEvent');
    }

    public function searchAction()
    {
        return $this->render('@Club/Evenement/search.html.twig', array(
            // ...
        ));
    }
    public function front_view_eventAction()
    {
        $r=$this->getDoctrine()->getRepository(Evenement::class)->findAll();
        return $this->render('@Club/Evenement/front/event_view.html.twig', array("Evenement"=>$r));
    }
}
