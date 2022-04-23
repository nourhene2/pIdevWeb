<?php

namespace App\Controller;

use App\Entity\Capsule;
use App\Form\CapsuleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CapsuleRepository;
use DateTime;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;




class CapsuleController extends AbstractController
{
    /**
     * @Route("/capsule", name="capsule")
     */
    public function index(): Response
    {
        return $this->render('capsule/index.html.twig', [
            'controller_name' => 'CapsuleController',
        ]);
    }

    /**
     * @Route("/listCapsule", name="listCapsule")
     */
    public function listcapsules()
    {
        $capsules = $this->getDoctrine()->getRepository(Capsule::class)->findAll();
        return $this->render('capsule/list.html.twig', ["capsules" => $capsules]);
    } 

      /**
     * @Route("/addCapsule", name="addCapsule")
     */
    public function addCapsule(Request $request)
    {
        $capsule = new Capsule();
        $form = $this->createForm(CapsuleType::class, $capsule);
        $form->add("Ajouter", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            $fichier = $capsule->getNomcapsule() . '.' . $image->guessExtension();

            $image->move(
                $this->getParameter('images_directory'),
                $fichier
            );
           $capsule->setImage($fichier);
            $em = $this->getDoctrine()->getManager();
            //$capsule->setMoyenne(0);
            $em->persist($capsule);
            $em->flush();
            return $this->redirectToRoute('listCapsule');
        }
        return $this->render("capsule/add.html.twig", array('form' => $form->createView()));
    }

    /**
     * @Route("/deletecapsule/{id}", name="deleteCapsule")
     */
    public function deleteCapsule($id)
    {
        $capsule = $this->getDoctrine()->getRepository(Capsule::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($capsule);
        $em->flush();
        return $this->redirectToRoute("listCapsule");
    }

   

    /**
     * @Route("/updatecapsule/{id}", name="updateCapsule")
     */
    public function updateCapsule(Request $request, $id)
    {
        $capsule = $this->getDoctrine()->getRepository(Capsule::class)->find($id);
        $form = $this->createForm(CapsuleType::class, $capsule);
        $form->add("Modifier", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            $image = $form->get('image')->getData();
            $fichier = $capsule->getNomcapsule() . '.' . $image->guessExtension();

            $image->move(
                $this->getParameter('images_directory'),
                $fichier
            );
           $capsule->setImage($fichier);
            $em = $this->getDoctrine()->getManager();
            //$em->persist($capsule);
            $em->flush();
            return $this->redirectToRoute('listCapsule');
        }
        return $this->render("capsule/update.html.twig", array('form' => $form->createView()));
    }

/**
     * @Route("/capsuleback", name="capsuleback")
     */
    public function listProduit()
    {
        $Capsules= $this->getDoctrine()->getRepository(Capsule::class)->findAll();
        
        return $this->render('capsule/capsuleback.html.twig', ["Capsules" => $Capsules]);
    }





}