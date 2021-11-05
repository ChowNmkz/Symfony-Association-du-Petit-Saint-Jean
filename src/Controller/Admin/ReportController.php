<?php

namespace App\Controller\Admin;

use App\Entity\Report;
use App\Form\ReportType;
use App\Repository\ReportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ReportController extends AbstractController

/**
 * @Route("/admin/report", name="admin_report_")
 * @package App\Controller\Admin
 */

{
    #[Route('/', name: 'home')]
    public function index(ReportRepository $repRepo)
    {
        return $this->render('admin/report/index.html.twig', [
            'report' => $repRepo->findAll()
        ]);
    }

    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajoutReport(Request $request)
    {
        $report = new Report;

        $form = $this->createForm(ReportType::class, $report);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $date = $form->get('Date')->getData();
            dd($date);
            $em = $this->getDoctrine()->getManager();
            $em->persist($report);
            $em->flush();

            return $this->redirectToRoute('admin_report_home');
        }

        return $this->render('admin/report/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function ModifReport(Report $report, Request $request)
    {
        $form = $this->createForm(ReportType::class, $report);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($report);
            $em->flush();

            return $this->redirectToRoute('admin_report_home');
        }

        return $this->render('admin/report/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }
}