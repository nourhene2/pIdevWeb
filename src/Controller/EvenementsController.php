<?php
/* BACKEND */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use  App\Entity\Evenements;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\EvenementsType;


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

        return $this->render('evenements/list.html.twig', ["Evenement" => $Evenement]);
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
        if ($form->isSubmitted()) {
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
}
