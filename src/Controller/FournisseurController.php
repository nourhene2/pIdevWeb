<?php



namespace App\Controller;
use App\Entity\Fournisseur;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\FournisseurType;
use Symfony\Component\Routing\Annotation\Route;


class FournisseurController extends AbstractController
{



     /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home.html.twig', [
            'controller_name' => 'FournisseurController',
        ]);
    }



    
    /**
     * @Route("/listFournisseur", name="listFournisseur")
     */
    public function listFournisseur()
    {
        $Fournisseurs = $this->getDoctrine()->getRepository(Fournisseur::class)->findAll();
        
        return $this->render('fournisseur/list.html.twig', ["Fournisseurs" => $Fournisseurs]);
    }


       /**
     * @Route("/addFournisseur", name="addFournisseur")
     */
    public function addFournisseur(Request $request)
    {
        $Fournisseur = new Fournisseur();
        $form = $this->createForm(FournisseurType::class, $Fournisseur);
        $form->add("Ajouter", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
        











            $em = $this->getDoctrine()->getManager();
            //$commande->setMoyenne(0);
            $em->persist($Fournisseur);
            $em->flush();
            return $this->redirectToRoute('listFournisseur');
        }
        return $this->render("fournisseur/add.html.twig", array('form' => $form->createView()));
    }
   /**
     * @Route("/delete/{id}", name="deleteFournisseur")
     */
    public function deleteFournisseur($id)
    {
        $Fournisseur = $this->getDoctrine()->getRepository(Fournisseur::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Fournisseur);
        $em->flush();
        return $this->redirectToRoute("listFournisseur");
    }
    
    /**
     * @Route("/updateF/{id}", name="updateFournisseur")
     */
    public function updateFournisseur(Request $request, $id)
    {
        $Fournisseur = $this->getDoctrine()->getRepository(Fournisseur::class)->find($id);
        $form = $this->createForm(FournisseurType::class, $Fournisseur);
        $form->add("Modifier", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listFournisseur');
        }
        return $this->render("fournisseur/update.html.twig", array('form' => $form->createView()));
    }
}
