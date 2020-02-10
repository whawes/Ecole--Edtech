<?php

namespace ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClubsController extends Controller
{
    public function addAction()
    {
        return $this->render('ClubBundle:Clubs:add.html.twig', array(
            // ...
        ));
    }

    public function updateAction()
    {
        return $this->render('ClubBundle:Clubs:update.html.twig', array(
            // ...
        ));
    }

    public function deleteAction()
    {
        return $this->render('ClubBundle:Clubs:delete.html.twig', array(
            // ...
        ));
    }

    public function viewAction()
    {
        return $this->render('ClubBundle:Clubs:view.html.twig', array(
            // ...
        ));
    }

}
