<?php
/* FRONTEND */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use  App\Entity\Reclamations;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\ReclamationsFType;


class ReclamationsControllerFController extends AbstractController
{
    /**
     * @Route("/reclamations/controller/f", name="app_reclamations_controller_f")
     */
    public function index(): Response
    {
        return $this->render('reclamations_controller_f/index.html.twig', [
            'controller_name' => 'ReclamationsControllerFController',
        ]);
    }
    /**
     * @Route("/addReclamationF", name="addReclamationF")
     */
    public function addReclamationF(Request $request)
    {
        $Reclamation = new Reclamations();
        $form = $this->createForm(ReclamationsFType::class, $Reclamation);
        $form->add("Ajouter", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            //$Reclamations->setMoyenne(0);
            $em->persist($Reclamation);
            $em->flush();
            return $this->redirectToRoute('addReclamationF');
        }
        return $this->render("reclamations/createreclamationsf.html.twig", array('form' => $form->createView()));
    }
}
