<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     */
    public function showAction(User $user)
    {

        return $this->render('user/show.html.twig', array(
            'user' => $user,
        ));
    }



    public function AddCourseAction(Request $request, user $user)
    {
       // $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('AppBundle\Form\userType', $user);
        $editForm->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository('EdtechBundle:course');


        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $ids=$request->get('mesids');
            if ($ids!= NULL) {
                foreach ($ids as $value) {

                    $c = $repository->find($value);
                    $user->addCourse($c);
                }
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_addCourse', array('id' => $user->getId()));
        }


      /*  $query = $entityManager->createQueryBuilder('r')
            ->select('r.courses')
            ->from('AppBundle:User', 'r')
            ->where('r.id = :id')
            ->setParameter('id', $user->getId())
            ->getQuery();
        $data = $query->getArrayResult();*/

        return $this->render('user/addCourse.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
           // 'delete_form' => $deleteForm->createView(),
            'courses' => $repository->findAll()
        ));
    }
}