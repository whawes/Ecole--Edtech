<?php


namespace UserBundle\Controller;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\LineChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use EnseignantBundle\Entity\Absences;
use EnseignantBundle\Entity\Moyennes;
use EnseignantBundle\Entity\Notes;
use EnseignantBundle\Entity\Sanctions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;

class UserController extends Controller
{
    public function indexenseignantAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id=$user->getClasse();
        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $query = $repository->createQueryBuilder('e')
            ->where('e.roles=:role')
            ->setParameter('role', 'a:1:{i:0;s:10:"ROLE_ELEVE";}')
            ->getQuery();
        $eleves = $query->getResult();

        $neleves = count($eleves);

        $query = $repository->createQueryBuilder('e')
            ->where('e.roles=:role')->andWhere('e.classedeseleves=:classe')
            ->setParameter('role', 'a:1:{i:0;s:10:"ROLE_ELEVE";}')->setParameter('classe',$id)
            ->getQuery();
        $eleves = $query->getResult();

        $nelevesclasse = count($eleves);

        $repository = $this->getDoctrine()->getRepository(Moyennes::class);

        $query = $repository->createQueryBuilder('a')->orderBy('a.eleve', 'ASC')->getQuery();
        $moyennes=$query->getResult();
        $data = array();

        if($moyennes!=NULL)
        {
            $stat = ['matiere', 'moyenne', 'trimestre'];

            array_push($data, $stat);

            foreach ($moyennes as $moyenne)
            {
                $stat = array();
                array_push($stat, (string)$moyenne->getMatiere(), $moyenne->getMoyenne(), $moyenne->getTrimestre());
                array_push($data, $stat);
            }
        }

        $titre="evolution moyennes:";
        $Chart = new \CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart();
        $Chart->getData()->setArrayToDataTable($data);
        $Chart->getOptions()->setTitle($titre);
        $Chart->getOptions()
              ->setBars('vertical')
              ->setHeight(400)
              ->setWidth(600);
        return $this->render('user/indexenseignant.html.twig', array(
            'neleves' => $neleves,
            'nelevesclasse' => $nelevesclasse,
            'Chart' => $Chart,
        ));
    }

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

    public function usermoyennesmatiereAction($id, $matiere)
    {
        $repository = $this->getDoctrine()->getRepository(Moyennes::class);
        $query = $repository->createQueryBuilder('a')
            ->where('a.eleve=:id')->andWhere('a.matiere=:matiere')
            ->setParameter('id', $id)->setParameter('matiere',$matiere)
            ->getQuery();
        $moyennes = $query->getResult();

        $stats = ['trimestre', 'moyenne'];
        $data=[];
        array_push($data, $stats);

        foreach ($moyennes as $moyenne)
        {
            $stat = array();
            array_push($stat, $moyenne->getTrimestre(), $moyenne->getMoyenne());
            array_push($data, $stat);
        }


        $Chart=new LineChart();
        $titre="Evolution annuelle de la moyenne de ".$moyennes[0]->getMatiere();
        $Chart->getData()->setArrayToDataTable($data);
        $Chart->getOptions()->setTitle($titre);
        $Chart->getOptions()
               ->setHeight(400)
               ->setWidth(600);

        return $this->render('user/moyennesmatiere.html.twig', array
        ('moyennes' => $moyennes, 'Chart' => $Chart,
        ));
    }

    public function usermoyennesAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Moyennes::class);
        $query = $repository->createQueryBuilder('a')
            ->where('a.eleve=:id')
            ->setParameter('id', $id)
            ->getQuery();
        $moyennes = $query->getResult();

        if($moyennes!=NULL)
        {
            $query = $repository->createQueryBuilder('a')
                                ->groupBy('a.matiere')
                                ->getQuery();

            $matieres = $query->getResult();

            return $this->render('user/moyennes.html.twig', array(
                    'moyennes' => $moyennes, 'matieres' => $matieres,)
            );
        }

        return $this->render('user/moyennes.html.twig', array(
            'moyennes' => $moyennes,));
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

        $query = $repository->createQueryBuilder('a')
            ->where('a.eleve=:id')
            ->setParameter('id', $id)->groupBy('a.matiere','a.type')
            ->getQuery();

        $notesgrouped = $query->getResult();

        $Chart = new \CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart();
        $data = array();
        $stats = ['matiere', 'valeur', 'trimestre'];
        array_push($data, $stats);

        foreach ($notesgrouped as $note)
        {
            $stat = array();
            array_push($stat, $note->getType(),  $note->getValeur(), $note->getIdtrimestre());
            array_push($data, $stat);
        }

        $Chart->getData()->setArrayToDataTable($data);
        return $this->render('user/notes.html.twig', array
        ('notes' => $notes, 'Chart' => $Chart,
            ));
    }

    public function userabsencesAction($id)
    {
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
        $repository = $this->getDoctrine()
            ->getRepository(Sanctions::class);
        $query = $repository->createQueryBuilder('a')
            ->where('a.eleve=:id')
            ->setParameter('id', $id)
            ->getQuery();
        $sanctions = $query->getResult();

        $data= array();

        $stat=['Punition', 'nombre'];
        array_push($data,$stat);
        $i=0;

        foreach($sanctions as $sanction)
        {
            $stat=array();
            array_push($stat,$sanction->getPunition(),sizeof($sanction));
            array_push($data,$stat);
            $i++;
        }

        $titre="Les sanctions:";

        $Chart = new \CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart();

        $Chart->getData()->setArrayToDataTable($data);
        $Chart->getOptions()->setTitle($titre);
        $Chart->getOptions()
            ->setBars('vertical')
            ->setHeight(400)
            ->setWidth(600);


        return $this->render('user/sanctions.html.twig', array(
            'sanctions' => $sanctions, 'Chart' => $Chart,
        ));
    }

}