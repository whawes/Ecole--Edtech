<?php


namespace UserBundle\Controller;
use EnseignantBundle\Entity\Absences;
use EnseignantBundle\Entity\Notes;
use EnseignantBundle\Entity\Sanctions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;

class UserController extends Controller
{
    public function indexclassesAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id=$user->getClasse();
        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $query = $repository->createQueryBuilder('e')
            ->where('e.roles=:role')->andWhere('e.classedeseleves=:classe')
            ->setParameter('role', 'a:1:{i:0;s:10:"ROLE_ELEVE";}')->setParameter('classe',$id)->orderBy('e.classe')
            ->getQuery();
        $eleves = $query->getResult();
        return $this->render('classes/index.html.twig', array(
            'eleves' => $eleves,
        ));
    }

    public function espaceparentAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id=$user->getId();
        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $query = $repository->createQueryBuilder('e')
            ->where('e.parent=:id')
            ->setParameter('id', $id)
            ->getQuery();
        $eleves = $query->getResult();

        return $this->render('user/espaceparent.html.twig', array(
            'eleves' => $eleves,
        ));
    }

    public function usernotesAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
            ->getRepository(Notes::class);
        $query = $repository->createQueryBuilder('a')
            ->where('a.eleve=:id')
            ->setParameter('id', $id)
            ->getQuery();
        $notes = $query->getResult();

        return $this->render('user/notes.html.twig', array(
            'notes' => $notes,
        ));
    }

    public function userabsencesAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
            ->getRepository(Absences::class);
        $query = $repository->createQueryBuilder('a')
            ->where('a.eleve=:id')
            ->setParameter('id', $id)
            ->getQuery();
        $absences = $query->getResult();

        return $this->render('user/absences.html.twig', array(
            'absences' => $absences,
        ));
    }

    public function usersanctionsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
            ->getRepository(Sanctions::class);
        $query = $repository->createQueryBuilder('a')
            ->where('a.eleve=:id')
            ->setParameter('id', $id)
            ->getQuery();
        $sanctions = $query->getResult();

        return $this->render('user/sanctions.html.twig', array(
            'sanctions' => $sanctions,
        ));
    }

}