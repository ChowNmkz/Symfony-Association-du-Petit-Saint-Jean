<?php

namespace App\Controller\Admin;

use App\Entity\ImportPdf;
use App\Form\GazetteType;
use App\Repository\ImportPdfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ImportPdfController extends AbstractController

/**
 * @Route("/admin/gazette", name="admin_gazette_")
 * @package App\Controller\Admin
 */

{
    #[Route('/', name: 'home')]
    public function index(ImportPdfRepository $pdfRepo)
    {
        return $this->render('admin/import_pdf/index.html.twig', [
            'import_pdf' => $pdfRepo->findAll()
        ]);
    }

    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajoutPdf(Request $request): Response
    {
        $pdf = new ImportPdf;

        //$form = $this->createFormBuilder(new ImportPdf());
        $form = $this->createForm(GazetteType::class, $pdf);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pdf = new ImportPdf;
            // On récupére l'image
            $img_pdf = $form->get('path_pdf')->getData();
            // On récupére le titre de l'image
            $name = $form->get('title')->getData();
            // Gestion du nom de l'image
            $name = strtr(utf8_decode($name), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
            $name = strtolower($name);
            $name = str_replace(" ", "_", $name);
            $title_pdf = $name . '_' . uniqid() . '.' . $img_pdf->guessExtension();
            // On prépare le déplacement dans le fichier cible 'images_directory'
            $destination = $this->getParameter('images_directory');
            // On déplace le fichier dans images_directory -> qui relate Upload du fichier Public
            $img_pdf->move($destination, $title_pdf);
            $pdf->setPathPdf($title_pdf);            
            $pdf->setDate(new \DateTime("now"));
            $pdf->setTitle($name);
            // On l'enregistre en base de donnée
            $em = $this->getDoctrine()->getManager();
            $em->persist($pdf);
            $em->flush();
            
            return $this->redirectToRoute('admin_gazette_home');
        }

        return $this->render('admin/import_pdf/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function ModifDoleances(ImportPdf $pdfmod, Request $request)
    {
        $form = $this->createForm(GazetteType::class, $pdfmod);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pdfmod);
            $em->flush();

            return $this->redirectToRoute('admin_gazette_home');
        }

        return $this->render('admin/import_pdf/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer")
     */
    public function delete(Request $request, ImportPdf $pdf): Response
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pdf);
            $em->flush();
        
        return $this->redirectToRoute('admin_gazette_home', [], Response::HTTP_SEE_OTHER);
    }
}