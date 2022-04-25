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
use App\Repository\ReclamationRepository;
use Dompdf\Dompdf;
use Dompdf\Options;

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
     * @Route("/pdf", name="PDF")
     */
    public function PDFReclamation()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $Reclamation = $this->getDoctrine()->getRepository(Reclamations::class)->findAll();
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('reclamations/listPdf.html.twig', [
            'Reclamation' => $Reclamation,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("ListeDesReclamations.pdf", [
            "Reclamations" => true
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
    public function addReclamation(Request $request,\Swift_Mailer $mailer)
    {
        $Reclamation = new Reclamations();
        $form = $this->createForm(ReclamationsType::class, $Reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$Reclamations->setMoyenne(0);
            $Reclamation->setDateR(new \DateTime());
            $em->persist($Reclamation);
            $em->flush();
$abc =$Reclamation->getContenuR();


 //mailing
            //on cree le message
            $message = (new \Swift_Message('Une nouvelle réclamation a étè ajoutée !'))
                //ili bech yeb3ath
                ->setFrom('mohamedamineaouididi08@gmail.com')
                //ili bech ijih l message
                ->setTo('molkazahra@gmail.com')
                ->setBody(
                    $abc
                );
            //on envoi l email
            $mailer->send($message);

            return $this->redirectToRoute('addReclamation');
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







/**
     * @Route("/listH", name="listH", methods={"GET"})
     */
    public function listH(ReclamationRepository $res) :Response
    {


        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $reader=$res->findAll();


        // Retrieve the HTML generated in our twig file

        $html = $this->renderView('reclamations/listPDF.html.twig', array(
            'reader'=>$reader
        ));

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A3', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Liste Des Reclamations.pdf", [
            "Attachment" => true
        ]);

        // Send some text response
        return new Response("The PDF file has been succesfully generated !");

    }

    /**
     * @Route("/searchZahra", name="Zahrasearch", methods={"GET"})
     */
    public function searchPlanajax(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Reclamations::class);
        $requestString=$request->get('searchValue');
        $plan = $repository->findPlanBySujet($requestString);
        return $this->render('evenements/ajaxtable.html.twig', [
            'util' => $plan,
        ]);

    }
   
}
