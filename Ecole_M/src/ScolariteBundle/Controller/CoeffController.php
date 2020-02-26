<?php

namespace ScolariteBundle\Controller;

use ScolariteBundle\Entity\Coeff;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Coeff controller.
 *
 * @Route("coeff")
 */
class CoeffController extends Controller
{
    /**
     * Lists all coeff entities.
     *
     * @Route("/", name="coeff_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $coeffs = $em->getRepository('ScolariteBundle:Coeff')->findAll();

        return $this->render('coeff/index.html.twig', array(
            'coeffs' => $coeffs,
        ));
    }

    /**
     * Creates a new coeff entity.
     *
     * @Route("/new", name="coeff_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $coeff = new Coeff();
        $form = $this->createForm('ScolariteBundle\Form\CoeffType', $coeff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($coeff);
            $em->flush();

            return $this->redirectToRoute('coeff_index', array('id' => $coeff->getId()));
        }

        return $this->render('coeff/new.html.twig', array(
            'coeff' => $coeff,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a coeff entity.
     *
     * @Route("/{id}", name="coeff_show")
     * @Method("GET")
     */
    public function showAction(Coeff $coeff)
    {
        $deleteForm = $this->createDeleteForm($coeff);

        return $this->render('coeff/show.html.twig', array(
            'coeff' => $coeff,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing coeff entity.
     *
     * @Route("/{id}/edit", name="coeff_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Coeff $coeff)
    {
        $deleteForm = $this->createDeleteForm($coeff);
        $editForm = $this->createForm('ScolariteBundle\Form\CoeffType', $coeff);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coeff_edit', array('id' => $coeff->getId()));
        }

        return $this->render('coeff/edit.html.twig', array(
            'coeff' => $coeff,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a coeff entity.
     *
     * @Route("/{id}", name="coeff_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Coeff $coeff)
    {
        $form = $this->createDeleteForm($coeff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($coeff);
            $em->flush();
        }

        return $this->redirectToRoute('coeff_index');
    }

    /**
     * Creates a form to delete a coeff entity.
     *
     * @param Coeff $coeff The coeff entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Coeff $coeff)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('coeff_delete', array('id' => $coeff->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function supprimerCAction($id)
    {
        $c=$this->getDoctrine()->getRepository(Coeff::class)->find($id);
        $en=$this->getDoctrine()->getManager();
        $en->remove($c);
        $en->flush();

        return $this->redirectToRoute('coeff_index');
    }
}
