<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class SecurityController extends Controller
{

    public function getTokenAction()
    {
        return new Response($this->container->get('form.csrf_provider')
            ->generateCsrfToken('authenticate'));
    }

    /**
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Security:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/home")
     */
    public function redirectAction()
    {
        $authCheker =$this->container->get('security.authorization_checker');
        if($authCheker->isGranted('ROLE_ADMIN')){return $this->redirectToRoute('back_sujet');}
        else if ($authCheker->isGranted('ROLE_Agent'))
        {return $this->redirectToRoute('edtech_homepage');}
        else {return $this->redirectToRoute('edtech_homepage');}

    }

}
