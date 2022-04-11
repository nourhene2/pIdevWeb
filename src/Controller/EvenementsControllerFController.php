<?php
/* FRONTEND */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use  App\Entity\Evenements;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\EvenementsType;
class EvenementsControllerFController extends AbstractController
{
    /**
     * @Route("/evenements/controller/f", name="app_evenements_controller_f")
     */
    public function index(): Response
    {
        return $this->render('evenements_controller_f/index.html.twig', [
            'controller_name' => 'EvenementsControllerFController',
        ]);
    }
    /**
     * @Route("/listEvenementF", name="listEvenementF")
     */
    public function listEvenementF()
    {
        $Evenement= $this->getDoctrine()->getRepository(Evenements::class)->findAll();

        return $this->render('evenements/listf.html.twig', ["Evenement" => $Evenement]);
    }
}
