<?php
/* BACKEND */
namespace App\Controller;

use  App\Entity\Reclamations;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\ReclamationsType;
use Symfony\Component\Routing\Annotation\Route;

class ReclamationsController extends AbstractController
{
    /**
     * @Route("/reclamations", name="app_reclamations")
     */
    public function index(): Response
    {
        return $this->render('reclamations/index.html.twig', [
            'controller_name' => 'ReclamationsController',
        ]);
    }
    /**
     * @Route("/listReclamation", name="listReclamation")
     */
    public function listReclamation()
    {
        $Reclamation = $this->getDoctrine()->getRepository(Reclamations::class)->findAll();

        return $this->render('reclamations/list.html.twig', ["Reclamation" => $Reclamation]);
    }
     /**
     * @Route("/addReclamation", name="addReclamation")
     */
    public function addReclamation(Request $request)
    {
        $Reclamation = new Reclamations();
        $form = $this->createForm(ReclamationsType::class, $Reclamation);
        $form->add("Ajouter", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$Reclamations->setMoyenne(0);
            $em->persist($Reclamation);
            $em->flush();
            return $this->redirectToRoute('listReclamation');
        }
        return $this->render("reclamations/createreclamations.html.twig", array('form' => $form->createView()));
    }
     /**
     * @Route("/deleteReclamation/{idR}", name="deleteReclamation")
     */
    public function deleteReclamation($idR)
    {
        $Reclamation = $this->getDoctrine()->getRepository(Reclamations::class)->find($idR);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Reclamation);
        $em->flush();
        return $this->redirectToRoute("listReclamation");
    }
    /**
     * @Route("/updateReclamation/{idR}", name="updateReclamation")
     */
    public function updateReclamation(Request $request, $idR)
    {
        $Reclamation = $this->getDoctrine()->getRepository(Reclamations::class)->find($idR);
        $form = $this->createForm(ReclamationsType::class, $Reclamation);
        $form->add("Modifier", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listReclamation');
        }
        return $this->render("reclamations/update.html.twig", array('form' => $form->createView()));
    }
}
