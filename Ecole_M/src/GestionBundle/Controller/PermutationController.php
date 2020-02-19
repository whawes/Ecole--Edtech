<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\Permutation;
use GestionBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Permutation controller.
 *
 * @Route("permutation")
 */
class PermutationController extends Controller
{
    /**
     * Lists all permutation entities.
     *
     * @Route("/", name="permutation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $permutations = $em->getRepository('GestionBundle:Permutation')->findBy(array('iduser' => $user->getId()));

        return $this->render('permutation/index.html.twig', array(
            'permutations' => $permutations,
        ));
    }

    /**
     * Creates a new permutation entity.
     *
     * @Route("/new", name="permutation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $permutation = new Permutation();
        $permutation->setDate(new \DateTime('now'));
        $permutation->setEtat("non traitee");
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $permutation->setIduser($user->getId());
        $form = $this->createForm('GestionBundle\Form\PermutationType', $permutation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($permutation);
            $em->flush();

            return $this->redirectToRoute('permutation_show', array('id' => $permutation->getId()));
        }

        return $this->render('permutation/new.html.twig', array(
            'permutation' => $permutation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a permutation entity.
     *
     * @Route("/{id}", name="permutation_show")
     * @Method("GET")
     */
    public function showAction(Permutation $permutation)
    {
        $deleteForm = $this->createDeleteForm($permutation);

        return $this->render('permutation/show.html.twig', array(
            'permutation' => $permutation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing permutation entity.
     *
     * @Route("/{id}/edit", name="permutation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Permutation $permutation)
    {
        $deleteForm = $this->createDeleteForm($permutation);
        $editForm = $this->createForm('GestionBundle\Form\PermutationType', $permutation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('permutation_index', array('id' => $permutation->getId()));
        }

        return $this->render('permutation/edit.html.twig', array(
            'permutation' => $permutation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a permutation entity.
     *
     * @Route("/{id}", name="permutation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Permutation $permutation)
    {
        $form = $this->createDeleteForm($permutation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($permutation);
            $em->flush();
        }

        return $this->redirectToRoute('permutation_index');
    }
    public function supprimerAction($id)
    {
        $c=$this->getDoctrine()->getRepository(Permutation::class)->find($id);
        $en=$this->getDoctrine()->getManager();
        $en->remove($c);
        $en->flush();
        return $this->redirectToRoute('permutation_index');
    }

    /**
     * Creates a form to delete a permutation entity.
     *
     * @param Permutation $permutation The permutation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Permutation $permutation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('permutation_delete', array('id' => $permutation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
