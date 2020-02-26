<?php

namespace EnseignantBundle\Controller;

use EnseignantBundle\Entity\Bulletin;
//use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use EnseignantBundle\Form\BulletinType;
/**
 *
 *
 * @Route("bulletin")
 */
class BulletinController extends Controller
{

    public function CAction(Request $request,$eleve,$tr)
    {
        $moyenne = new Bulletin();
        $moyenne->setEleve($eleve);


        $em = $this->getDoctrine()->getManager()->getRepository(Bulletin::class);
       // $results = $em->MEleve($eleve, $tr);
        $results = $em->REleve1($eleve, $tr);
        if ($results) {
            foreach ($results as $row) {
                $res=$row['classe'];
                $p=$em->REleve2($res,$tr);
                foreach ($p as $r)
                {
                    $r = $row['moyG'];
                    $moyenne->setMoyenne($r);

                    $em->persist($moyenne);
                    $em->flush();
                    return $this->redirectToRoute('classe_index');
                }
                //$m = $row['moyG'];

            }
        }
        return $this->redirectToRoute('classe_index');
       /* $c=$this->getDoctrine()->getRepository(Classe::class);
        $e=$c->REleve1($el,$tr);
        foreach ($e as $row)
        {
            $res=$row['classe'];
            $p=$c->REleve2($res,$tr);
            return $this->render('seance/test.html.twig',array("sp" => $p));
        }*/
    }





    /**
     *
     *
     * @Route("/{id}", name="bulletin_show")
     * @Method("GET")
     */
    public function showAction(Bulletin $classe)
    {
        $deleteForm = $this->createDeleteForm($classe);

        return $this->render('bulletin/show.html.twig', array(
            'classe' => $classe,
            'delete_form' => $deleteForm->createView(),
        ));
    }
}
