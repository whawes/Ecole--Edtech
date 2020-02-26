<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\Attestation;
use GestionBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Attestation controller.
 *
 * @Route("attestation")
 */
class AttestationController extends Controller
{
    /**
     * Lists all attestation entities.
     *
     * @Route("/", name="attestation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $attestations = $em->getRepository('GestionBundle:Attestation')->findBy(array('iduser' => $user->getId()));

        return $this->render('attestation/index.html.twig', array(
            'attestations' => $attestations,
        ));
    }

    /**
     * Creates a new attestation entity.
     *
     * @Route("/new", name="attestation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $attestation = new Attestation();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $attestation->setIduser($user->getId());
        $attestation->setDate(new \DateTime('now'));
        $attestation->setEtat("non traitee");
        //$form = $this->createForm('GestionBundle\Form\AttestationType', $attestation);
       // $form->handleRequest($request);

       // if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($attestation);
            $em->flush();

            return $this->redirectToRoute('attestation_show', array('id' => $attestation->getId()));
        //}

        return $this->render('attestation/new.html.twig', array(
            'attestation' => $attestation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a attestation entity.
     *
     * @Route("/{id}", name="attestation_show")
     * @Method("GET")
     */
    public function showAction(Attestation $attestation)
    {
        $deleteForm = $this->createDeleteForm($attestation);

        return $this->render('attestation/show.html.twig', array(
            'attestation' => $attestation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing attestation entity.
     *
     * @Route("/{id}/edit", name="attestation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Attestation $attestation)
    {
        $deleteForm = $this->createDeleteForm($attestation);
        $editForm = $this->createForm('GestionBundle\Form\AttestationType', $attestation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('attestation_index', array('id' => $attestation->getId()));
        }

        return $this->render('attestation/edit.html.twig', array(
            'attestation' => $attestation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a attestation entity.
     *
     * @Route("/{id}", name="attestation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Attestation $attestation)
    {
        $form = $this->createDeleteForm($attestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($attestation);
            $em->flush();
        }

        return $this->redirectToRoute('attestation_index');
    }

    public function supprimerAction($id)
    {
        $c=$this->getDoctrine()->getRepository(Attestation::class)->find($id);
        $en=$this->getDoctrine()->getManager();
        $c->setEtat("traitee");
        $en->remove($c);
        $en->flush();return $this->redirectToRoute('attestation_index');
    }

    public function traiterAction($id)
    {
        $c=$this->getDoctrine()->getRepository(Attestation::class)->find($id);
        $user=$this->getDoctrine()->getRepository(User::class)->find($c->getIduser());
        $en=$this->getDoctrine()->getManager();
        $c->setEtat("traitee");
        $en->persist($c);
        $en->flush();

        $username='topisland123@gmail.com';
        $message= \Swift_Message::newInstance()
            ->setSubject('Attestation')
            ->setFrom($username)
            ->setTo($user->getEmail())
            ->setBody('Votre attestation a été traitée');
        $this->get('mailer')->send($message);


        return $this->redirectToRoute('consulter_attestation');
    }

    public function indexadminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $attestations = $em->getRepository('GestionBundle:Attestation')->findAll();

        return $this->render('attestation/adminconsulter.html.twig', array(
            'attestations' => $attestations,
        ));
    }

    public function adminsupprimerAction($id)
    {
        $c=$this->getDoctrine()->getRepository(Attestation::class)->find($id);
        $en=$this->getDoctrine()->getManager();
        $en->remove($c);
        $en->flush();
        return $this->redirectToRoute('consulter_attestation');
    }


    /**
     * Creates a form to delete a attestation entity.
     *
     * @param Attestation $attestation The attestation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Attestation $attestation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('attestation_delete', array('id' => $attestation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
