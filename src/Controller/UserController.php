<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\EditProfileType;
use App\Repository\UserRepository;

use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/users")
 */

class UserController extends AbstractController
{
    /**
     * @Route("/", name="users")
     */
    public function users(){
        return $this->render('users/profil.html.twig');
    }
  










    /** 
     * @Route("/ModifierProfile", name="modifier_user_profile")
     */
    public function ModifierProfile(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $this->addFlash('message', 'Profile is updated');
                return $this->redirectToRoute('users');
            }

        return $this->render('users/edit_profile.html.twig',[
            'editProfileForm' => $form->createView(),
        ]);
    }




    /**
     * @Route("/changepassword", name="change_password")
     */
    public function changeUserPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    { 
        if($request->isMethod('POST')){

            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();
            if($passwordEncoder->isPasswordValid($user, $request->request->get('old-pass'))){
                if($request->request->get('pass') == $request->request->get('pass2')){
                    $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('pass')));
                    $em->flush();

                    return $this->redirectToRoute('users');
                }else{
                    $this->addFlash('error', 'The passwords are not identical');
                }
            }else{
                $this->addFlash('error', 'Old Password is not valid');
            }

        }

        return $this->render('users/edit_password.html.twig');
    }
    /** 
     * @Route("/testrecherche",name="testrecherche")
    */
    public function searchLivAction(Request $request,NormalizerInterface $Normalizer){
        $repository = $this->getDoctrine()->getRepository(User::class);
        $requestString=$request->get('User');
        $users = $repository->findUserByName($requestString);
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($users, 'json',['ignored_attributes'=>['password','roles','image','captchaCode','isVerified','isBlocked','regimes','fullname']]);
        $retour=json_encode($jsonContent);
        return new Response($retour);


    }

   
    
}    


