<?php

namespace App\Controller\Admin;

use App\Entity\ImportPhoto;
use App\Entity\Evenement;
use App\Form\ImportPhotoType;
use App\Repository\ImportPhotoRepository;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/photo", name="admin_photo_")
 * @package App\Controller\Admin
 */

class ImportPhotoController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(ImportPhotoRepository $importPhotoRepository): Response
    {
        return $this->render('admin/import_photo/index.html.twig', [
            'import_photos' => $importPhotoRepository->findAll(),
        ]);
    }

    #[Route('/ajout', name: 'ajout', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        // On instancie ImportPhoto
        $importPhoto = new ImportPhoto();
        // On instancie Evenement 
        $evenement = new Evenement();
        $form = $this->createForm(ImportPhotoType::class, $importPhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupére les images transmises
            $photos = $form->get('path_photo')->getData();
            // On récupére le titre du lot d'image
            $title = $form->get('Title')->getData();
            // On récupére l'évènement associé aux photos
            $evenement = $form->get('evenement')->getData();

            // On boucle sur les images
            foreach($photos as $Photo){
                // On génére un nouveau nom de fichier en retirant les espaces et en y ajoutant un seed unique grace à la methode uniqid()
                $title = strtolower($title);
                $title = str_replace(" ", "_", $title);
                $fichier = $title . uniqid() . '.' . $Photo->guessExtension();
                $titleImg = $title . '_' . uniqid();
                $destination = $this->getParameter('images_directory');
                $Photo->move($destination, $fichier);
                // On stocke le nom de la photo dans la base de données 
                    //On créer une nouvelle instance de l'entité ImportPhoto
                $img = new ImportPhoto();
                    //On paramétre la date sur la date du jours
                $img->setdate(new \DateTime("now"));
                    // On paramétre le titre
                $img->setTitle($titleImg);
                    //On paramétre le nom du fichier qui est dans le dossier /public/upload
                $img->setPathPhoto($fichier);
                    // On paramétre l'événement grace à l'entity Evenement
                $img->setEvenement($evenement);
                    // On appelle notre EntityManager
                $em = $this->getDoctrine()->getManager();
                    // On "stage" nos données 
                $em->persist($img);
                    // On envoie nos données dans la DB
                $em->flush();
            }


            return $this->redirectToRoute('admin_photo_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/import_photo/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/modifier/{id}', name: 'modifier', methods: ['GET','POST'])]
    public function edit(Request $request, ImportPhoto $importPhoto): Response
    {
        $form = $this->createForm(ImportPhotoType::class, $importPhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_photo_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/import_photo/ajout.html.twig', [
            'import_photo' => $importPhoto,
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'supprimer', methods: ['POST'])]
    public function delete(Request $request, ImportPhoto $importPhoto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$importPhoto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($importPhoto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_photo_home', [], Response::HTTP_SEE_OTHER);
    }
}
