<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class FormationController
 * @package App\Controller\Admin
 * @Route("/admin/users")
 */
class AdminController extends AbstractController
{


    /**
     * @Route("/{id}", name="user_back_show")
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return $this->render('admin/show.html.twig',[
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_back_edit")
     * @param Request $request
     * @param User $user
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $encodedPassword = $userPasswordEncoder->encodePassword(
                $user,
                $form->get('plainPassword')->getData()
            );

            $user->setPassword($encodedPassword);
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('Users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }





    /**
     * @Route("/delete/{id}", name="user_back_delete")
     * @param Request $request
     * @param User $user
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))){
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Users', [], Response::HTTP_SEE_OTHER);
        
    }
     
     
   





    
}