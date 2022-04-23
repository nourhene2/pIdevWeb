<?php



namespace App\Controller;
use App\Entity\Produit;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\ProduitType;
use App\Entity\Urlizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer ;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;



class ProduitController extends AbstractController
{
  
    /**
     * @Route("/produits", name="affichageproduit")
     */
    public function affichageProduit()
    {
        $Produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        
        return $this->render('Produit/produit.html.twig', ["Produits" => $Produits]);
    }



    
    /**
     * @Route("/listProduit", name="listProduit")
     */
    public function listProduit()
    {
        $Produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        
        return $this->render('Produit/list.html.twig', ["Produits" => $Produits]);
    }


       /**
     * @Route("/addProduit", name="addProduit")
     */
    public function addProduit(Request $request)
    {
        $Produit = new Produit();
        $form = $this->createForm(ProduitType::class, $Produit);
        $form->add("Ajouter", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {

          /** @var UploadedFile $uploadedFile */
          $uploadedFile = $form['image']->getData();
          $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
          $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
          $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
          $uploadedFile->move(
              $destination,
              $newFilename
          );
          $Produit->setImage($newFilename);


            $em = $this->getDoctrine()->getManager();
            //$commande->setMoyenne(0);
            $em->persist($Produit);
            $em->flush();
            return $this->redirectToRoute('listProduit');
        }
        return $this->render("Produit/add.html.twig", array('formP' => $form->createView()));
    }

    /**
 * @Route("/delete-Produit/{id}", name="deleteProduit")
 */
public function deleteReclamation(int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $Produit = $entityManager->getRepository(Produit::class)->find($id);
    $entityManager->remove($Produit);
    $entityManager->flush();
    $this->addFlash(
        'info',
      ' le Produit a été supprimer',  
  );

    return $this->redirectToRoute("listProduit");
}





    
    /**
     * @Route("/update-produit/{id}", name="updateProduit")
     */
    public function updateProduit(Request $request, $id)
    {
        $Produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
        $form = $this->createForm(ProduitType::class, $Produit);
        $form->add("Modifier", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listProduit');
        }
        return $this->render("Produit/update.html.twig", array('formP' => $form->createView()));
    }
}
