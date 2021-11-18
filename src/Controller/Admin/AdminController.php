<?php

namespace App\Controller\Admin;

use App\Entity\CommerceQuartier;
use App\Entity\Doleances;
use App\Entity\Evenement;
use App\Entity\ImportPdf;
use App\Entity\ImportPhoto;
use App\Entity\Report;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/', name: 'admin_home')]
    public function index(): Response
    { 
        $commerce = $this->getDoctrine()
            ->getRepository(CommerceQuartier::class)
            ->findOneBy(array(), array('id' => 'DESC'));
        //dd($commerce);
        
        $doleance = $this->getDoctrine()
            ->getRepository(Doleances::class)
            ->findOneBy(array(), array('id' => 'DESC'));
        //dd($doleance);

        $evenement = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->findOneBy(array(), array('id' => 'DESC'));
        //dd($evenement);

        $rapport = $this->getDoctrine()
            ->getRepository(Report::class)
            ->findOneBy(array(), array('id'=> 'DESC'));
        //dd($rapport);

        $gazette = $this->getDoctrine()
            ->getRepository(ImportPdf::class)
            ->findOneBy(array(), array('id' => 'DESC'));
        //dd($gazette);

        $photo = $this->getDoctrine()
            ->getRepository(ImportPhoto::class)
            ->findOneBy(array(), array('id' => 'DESC'));
        //dd($photo);

        return $this->render('admin/homeadmin.html.twig', [
            'evenement' => $evenement,
            'commerce' => $commerce,
            'doleance' => $doleance,
            'rapport' => $rapport,
            'gazette' => $gazette,
            'photo' => $photo
        ]);
    }

}