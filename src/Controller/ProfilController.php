<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



class ProfilController extends Controller
{


    /**    
     * @Route("/Users", name="Users")
     */
    public function Users(Request $request)
    {

        $repo = $this ->getDoctrine()->getRepository(User::class);
        $users=$repo->findAll();


        
        $users = $this->get('knp_paginator')->paginate(
     
            $users,
     
            $request->query->getInt('page', 1),
     
           10
        ); 

        return $this->render('backUser/Users.html.twig', [
            'controller_name' => 'profilController',
            'users' => $users
        ]);
    }





      /**
     * @Route("/ajax_search/", name="ajax_search")
     */
    public function chercher(Request $request)
    {

        echo("test");
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        
        $users=  $em->UserRepository->rechercheAvance($requestString);
        if(!$users) {
            $result['users']['error'] = "Vol non trouvé 🙁 ";
        } else {
            $result['users'] = $this->getRealEntities($users);
        }
        return new Response(json_encode($result));
    }
 
    public function getRealEntities($users){
        foreach ($users as $users){
            $realEntities[$users->getId()] = [$users->getEmail(),$users->getFirstname(),$users->getLastname()];

        }
        return $realEntities;
    }


}

