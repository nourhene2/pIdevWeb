<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use  App\Entity\Evenements;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\EvenementsType;
use App\Repository\EvenementRepository;
use Knp\Component\Pager\PaginatorInterface;


class EvenementsController extends AbstractController
{
    /**
     * @Route("/evenements", name="app_evenements")
     */
    public function index(): Response
    {
        return $this->render('evenements/index.html.twig', [
            'controller_name' => 'EvenementsController',
        ]);
    }

     /**
     * @Route("/listEvenement", name="listEvenement")
     */
    public function listEvenement()
    {
        $Evenement= $this->getDoctrine()->getRepository(Evenements::class)->findAll();

        return $this->render('evenements/list.html.twig', ["Evenements" => $Evenement]);
    }
     /**
     * @Route("/addEvenement", name="addEvenement")
     */
    public function addEvenement(Request $request)
    {
        $Evenement = new Evenements();
        $form = $this->createForm(EvenementsType::class, $Evenement);
        $form->add("Ajouter", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$Reclamations->setMoyenne(0);
            $em->persist($Evenement);
            $em->flush();
            return $this->redirectToRoute('listEvenement');
        }
        return $this->render("evenements/createevenments.html.twig", array('form' => $form->createView()));
    }

     /**
     * @Route("/deleteEvenement/{idE}", name="deleteEvenement")
     */
    public function deleteEvenement($idE)
    {
        $Evenement= $this->getDoctrine()->getRepository(Evenements::class)->find($idE);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Evenement);
        $em->flush();
        return $this->redirectToRoute("listEvenement");
    }
    /**
     * @Route("/updateEvenement/{idE}", name="updateEvenement")
     */
    public function updateEvenement(Request $request, $idE)
    {
        $Evenement= $this->getDoctrine()->getRepository(Evenements::class)->find($idE);
        $form = $this->createForm(EvenementsType::class, $Evenement);
        $form->add("Modifier", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listEvenement');
        }
        return $this->render("evenements/update.html.twig", array('form' => $form->createView()));
    }
      /**
     * @Route("/affEvenement", name="affEvenement")
     */
    public function afftEvenement(Request $request, PaginatorInterface $paginator)
    {
                // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
                $donnees= $this->getDoctrine()->getRepository(Evenements::class)->findAll();       
                $Evenement= $paginator->paginate(
                    $donnees, // Requête contenant les données à paginer (ici nos articles)
                    $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                    3 // Nombre de résultats par page
                );

        return $this->render('evenements/index.html.twig', ["Evenement" => $Evenement]);
    }
          /**
     * @Route("/affEvenementtrienom", name="affEvenementtrienom")
     */
    public function affEvenementtrienom(Request $request,EvenementRepository $EV)
    {
                // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
                $Evenement= $EV->orderByNomEv();       

        return $this->render('evenements/indexTrie.html.twig', ["Evenement" => $Evenement]);
    }
              /**
     * @Route("/affEvenementAdress", name="affEvenementAdress")
     */
    public function affEvenementAdress(Request $request,EvenementRepository $EV)
    {
                // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
                $Evenement= $EV->orderByAddresse();       

        return $this->render('evenements/indexTrie.html.twig', ["Evenement" => $Evenement]);
    }
              /**
     * @Route("/affEvenementtridate", name="affEvenementtridate")
     */
    public function affEvenementtridate(Request $request,EvenementRepository $EV)
    {
                // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
                $Evenement= $EV->orderByDate();       

        return $this->render('evenements/indexTrie.html.twig', ["Evenement" => $Evenement]);
    }
    /**
     * @Route("/stat",name="stat")
     */
    public function statistique(EvenementRepository $evenRepo){
        $evenements=$evenRepo->findAll();
         $evenNom = [];
         $evenNbP = [];

         foreach ($evenements as $evenement)
         {
            $evenNom[]= $evenement->getNomE();
            $evenNbP[]= $evenement->getNbrPers();
         }
      return  $this->render('evenements/stat.html.twig',
      [
          'evenNom' => json_encode($evenNom),
          'evenNbP' => json_encode($evenNbP)

      ]);
    }

   



}  
