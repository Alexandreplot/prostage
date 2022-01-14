<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

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

        $listeFormations = $repositoryFormation->findAll();

        return $this->render('pro_stages/formations.html.twig', ['listeFormations'=>$listeFormations]);
    }


    public function stages($id): Response
    {
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);//recup repository des stage ainsi que uniquement les stages concernés

        $stage = $repositoryStage->find($id);

        return $this->render('pro_stages/stages.html.twig', ['leStage'=>$stage]);
    }

    public function stage_entreprises($id): Response
    {
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

        $entreprise = $repositoryEntreprise->find($id);
        $listeStages = $repositoryStage->findByEntreprise($id);

        return $this->render('pro_stages/Stage_entreprises.html.twig', ['entreprise'=>$entreprise,
                                                                        'listeStages' => $listeStages]);
    }


    public function stage_formations($id): Response
    {
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);
        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);

        $formation = $repositoryFormation->find($id);
        $listeStages = $repositoryStage->findAll(); 

        return $this->render('pro_stages/Stage_formations.html.twig', ['formation'=>$formation,
                                                                    'listeStages'=>$listeStages]);
    } 

}

