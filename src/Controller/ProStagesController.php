<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;

class ProStagesController extends AbstractController
{

    public function index(): Response
    {
        $repositoryStages = $this->getDoctrine()->getRepository(Stage::class); //recup repository des stages

        $listeStages = $repositoryStages->findAll(); 

        return $this->render('pro_stages/index.html.twig', ['listeStages'=>$listeStages]);
    }


    public function entreprises(): Response
    {
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);//recup repository des stages

        $listeEntreprises = $repositoryEntreprise->findAll();
     

        return $this->render('pro_stages/entreprises.html.twig', ['listeEntreprises'=>$listeEntreprises]);
    }


    public function formations(): Response
    {
        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);//recup repository des formations

        $listeFormation = $repositoryFormation->findAll();

        return $this->render('pro_stages/formations.html.twig', ['listeFormations'=>$listeFormations]);
    }


    public function stages($id): Response
    {
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);//recup repository des stage ainsi que uniquement les stages concernés

        $listeStage = $repositoryStage->find($id);

        return $this->render('pro_stages/stages.html.twig', ['listeStage'=>$listeStage]);
    }
}
