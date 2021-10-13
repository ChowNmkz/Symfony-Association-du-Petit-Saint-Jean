<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class EvenementController extends AbstractController

/**
 * @Route("/admin/evenement", name="admin_evenement_")
 * @package App\Controller\Admin
 */

{
    #[Route('/', name: 'home')]
    public function index(EvenementRepository $evtRepo)
    {
        return $this->render('admin/evenement/index.html.twig', [
            'evenement' => $evtRepo->findAll()
        ]);
    }

    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajoutEvenement(Request $request)
    {
        $evenement = new Evenement;

        $form = $this->createForm(EvenementType::class, $evenement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('admin_evenement_home');
        }

        return $this->render('admin/evenement/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function ModifEvenement(Evenement $evenement, Request $request)
    {
        $form = $this->createForm(EvenementType::class, $evenement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('admin_evenement_home');
        }

        return $this->render('admin/evenement/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }
}