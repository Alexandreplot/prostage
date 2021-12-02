<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStagesController extends AbstractController
{
    /**
     * @Route("/", name="pro_stages")
     */
    public function index(): Response
    {
        return $this->render('pro_stages/index.html.twig', [
            'controller_name' => 'ProStagesController',
        ]);
    }

    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function entreprises(): Response
    {
        return $this->render('pro_stages/entreprises.html.twig', [
            'controller_name' => 'ProStagesController',
        ]);
    }

    /**
     * @Route("/formations", name="formations")
     */
    public function formations(): Response
    {
        return $this->render('pro_stages/formations.html.twig', [
            'controller_name' => 'ProStagesController',
        ]);
    }

    /**
     * @Route("/stages/", name="stages")
     */
    public function stages(): Response
    {
        return $this->render('pro_stages/stages.html.twig', [
            'controller_name' => 'ProStagesController',
        ]);
    }
}