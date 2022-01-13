<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        
        //FORMATIONS
        $dutInfo = new Formation();
        $dutInfo->setNomCourt("DUT Informatique");
        $dutInfo->setNomLong("Diplome Universitaire de Technologie en informatique");

        $lpProgAv = new Formation();
        $lpProgAv->setNomCourt("LP Prog-Av");
        $lpProgAv->setNomLong("Licence professionnelle programmation avancée");

        $lpNum = new Formation();
        $lpNum->setNomCourt("LP Num");
        $lpNum->setNomLong("Licence professionnelle des métiers du numérique");

        $dutGIM = new Formation();
        $dutGIM->setNomCourt("DUT GIM");
        $dutGIM->setNomLong("Diplome Universitaire de Technologie génie industriel et méchanique");

        $tabFormations = array($dutGIM, $dutInfo, $lpNum, $lpProgAv);
        
        foreach ($tabFormations as $formation){
            $manager->persist($formation);
        }

        //-----ENTREPRISES-----
        $nbEntreprises = 10;
    
        for ($i=1; $i <= $nbEntreprises; $i++){
            $entreprise = new Entreprise();
            $entreprise->setNom($faker->company());
            $entreprise->setActivite($faker->jobTitle());
            $entreprise->setAdresse($faker->address());
            $entreprise->setUrlSite($faker->domainName());

            $manager->persist($entreprise);

            $tabEntreprises[]=$entreprise;

        }

        //-----STAGES-----
        $nbStages = 30;

        for ($numStage=1; $numStage <= $nbStages; $numStage++){
            $stage = new Stage();
            $stage->setTitre($faker->jobTitle());
            $stage->setDescMission($faker->realText($maxNbChars = 300, $indexSize = 2));
            $stage->setEmailContact($faker->companyEmail());
            
            $entrepriseConcernee = $faker->numberBetween($min = 0, $max = count($tabEntreprises)-1);
            $tabEntreprises[$entrepriseConcernee] -> addStage($stage);
            $manager->persist($stage);

            $nbFormationsConcernees = $faker->numberBetween($min = 0, $max = count($tabFormations)-1);
            for($i=0; $i <= $nbFormationsConcernees; $i++){
                $formationConcernee = $faker->numberBetween($min = 0, $max = count($tabFormations)-1);
                $tabFormations[$formationConcernee] -> addStage($stage);
            }
            
            $manager->persist($stage);
        }

        $manager->flush();
    }
}
