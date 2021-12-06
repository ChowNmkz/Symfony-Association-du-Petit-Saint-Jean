<?php

namespace App\Controller;

use App\Entity\CommerceQuartier;
use App\Entity\Doleances;
use App\Entity\Evenement;
use App\Entity\ImportPdf;
use App\Entity\ImportPhoto;
use App\Entity\Report;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $commerce = $this->getDoctrine()
        ->getRepository(CommerceQuartier::class)
        ->findAll();
    //dd($commerce);
    
    $doleance = $this->getDoctrine()
        ->getRepository(Doleances::class)
        ->findAll();
    //dd($doleance);

    $evenement = $this->getDoctrine()
        ->getRepository(Evenement::class)
        ->findAll();
    //dd($evenement);

    $rapport = $this->getDoctrine()
        ->getRepository(Report::class)
        ->findAll();
    //dd($rapport);

    $gazette = $this->getDoctrine()
        ->getRepository(ImportPdf::class)
        ->findAll();
    //dd($gazette);

    $photo = $this->getDoctrine()
        ->getRepository(ImportPhoto::class)
        ->findAll();
    //dd($photo);

    return $this->render('home/index.html.twig', [
        'evenement' => $evenement,
        'commerce' => $commerce,
        'doleance' => $doleance,
        'rapport' => $rapport,
        'gazette' => $gazette,
        'photo' => $photo
    ]);
    }
}


