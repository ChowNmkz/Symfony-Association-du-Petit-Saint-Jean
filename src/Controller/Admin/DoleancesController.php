<?php

namespace App\Controller\Admin;

use App\Entity\Doleances;
use App\Form\DoleancesType;
use App\Repository\DoleancesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class DoleancesController extends AbstractController

/**
 * @Route("/admin/doleances", name="admin_doleances_")
 * @package App\Controller\Admin
 */

{
    #[Route('/', name: 'home')]
    public function index(DoleancesRepository $dolRepo)
    {
        return $this->render('admin/doleances/index.html.twig', [
            'doleances' => $dolRepo->findAll()
        ]);
    }

    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajoutDoleances(Request $request)
    {
        $doleances = new Doleances;

        $form = $this->createFormBuilder(new Doleances());
        $form = $this->createForm(DoleancesType::class, $doleances);
    

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $doleances -> setdate(new \DateTime("now"));
            $em->persist($doleances);
            $em->flush();
            

            return $this->redirectToRoute('admin_doleances_home');
        }

        return $this->render('admin/doleances/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function ModifDoleances(Doleances $doleances, Request $request)
    {
        $form = $this->createForm(DoleancesType::class, $doleances);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($doleances);
            $em->flush();

            return $this->redirectToRoute('admin_doleances_home');
        }

        return $this->render('admin/doleances/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }
}