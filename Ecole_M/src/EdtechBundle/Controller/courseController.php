<?php

namespace EdtechBundle\Controller;

use EdtechBundle\Entity\course;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Course controller.
 *
 * @Route("course")
 */
class courseController extends Controller
{
    /**
     * Lists all course entities.
     *
     * @Route("/", name="course_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $courses = $em->getRepository('EdtechBundle:course')->findAll();

        return $this->render('course/index.html.twig', array(
            'courses' => $courses,
        ));
    }

    /**
     * Creates a new course entity.
     *
     * @Route("/new", name="course_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $course = new Course();
        $form = $this->createForm('EdtechBundle\Form\courseType', $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($course);
            $em->flush();

            return $this->redirectToRoute('course_show', array('id' => $course->getId()));
        }

        return $this->render('course/new.html.twig', array(
            'course' => $course,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a course entity.
     *
     * @Route("/{id}", name="course_show")
     * @Method("GET")
     */
    public function showAction(course $course)
    {
        $deleteForm = $this->createDeleteForm($course);

        return $this->render('course/show.html.twig', array(
            'course' => $course,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing course entity.
     *
     * @Route("/{id}/edit", name="course_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, course $course)
    {
        $deleteForm = $this->createDeleteForm($course);
        $editForm = $this->createForm('EdtechBundle\Form\courseType', $course);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('course_edit', array('id' => $course->getId()));
        }

        return $this->render('course/edit.html.twig', array(
            'course' => $course,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a course entity.
     *
     * @Route("/{id}", name="course_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, course $course)
    {
        $form = $this->createDeleteForm($course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($course);
            $em->flush();
        }

        return $this->redirectToRoute('course_index');
    }

    /**
     * Creates a form to delete a course entity.
     *
     * @param course $course The course entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(course $course)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('course_delete', array('id' => $course->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function supprimerAction($id)
    {
        $c=$this->getDoctrine()->getRepository(course::class)->find($id);
        $en=$this->getDoctrine()->getManager();
        $en->remove($c);
        $en->flush();

        return $this->redirectToRoute('course_index');
    }
}
