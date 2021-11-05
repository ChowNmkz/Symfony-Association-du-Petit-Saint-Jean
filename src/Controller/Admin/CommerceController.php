<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CommerceQuartier as Commerce;
use App\Repository\CommerceQuartierRepository as CommerceRepository;
use App\Form\CommerceType;

class CommerceController extends AbstractController

/**
 * @Route("/admin/commerce", name="admin_commerce_")
 * @package App\Controller\Admin
 */

{
    #[Route('/', name: 'home')]
    public function index(CommerceRepository $comRepo)
    {
        return $this->render('admin/commerce/index.html.twig', [
            'commerce' => $comRepo->findAll()
        ]);
    }

    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajoutCommerce(Request $request)
    {
        $commerce = new Commerce;

        $form = $this->createForm(CommerceType::class, $commerce);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupére l'image
            $img = $form->get('img_path')->getData();
            $name = $form->get('Name')->getData();
            // Gestion du nom de l'image
            $name = strtr(utf8_decode($name), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
            $name = strtolower($name);
            $name = str_replace(" ", "_", $name);
            $title_img = $name . '_' . uniqid() . '.' . $img->guessExtension();
            $destination = $this->getParameter('images_directory');
            $img->move($destination, $title_img);
            $commerce->setImgPath($title_img);
            $em = $this->getDoctrine()->getManager();
            $em->persist($commerce);
            $em->flush();

            return $this->redirectToRoute('admin_commerce_home');
        }

        return $this->render('admin/commerce/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function ModifCommerce(Commerce $commerce, Request $request)
    {
        $form = $this->createForm(CommerceType::class, $commerce);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commerce);
            $em->flush();

            return $this->redirectToRoute('admin_commerce_home');
        }

        return $this->render('admin/commerce/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }
}