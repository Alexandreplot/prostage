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
        $info = new Formation();
        $info->setNomCourt("DUT Info");
        $info->setNomLong("Diplome Universitaire Technologique Informatique");

        $gim = new Formation();
        $gim->setNomCourt("DUT GIM");
        $gim->setNomLong("Diplome Universitaire Génie industrie méchanique");

        $lpPa = new Formation();
        $lpPa->setNomCourt("LP PA");
        $lpPa->setNomLong("Licence Professionnelle programation avancé");

        $tabFormations = array($info,$gim,$lpPa);
        foreach ($tabFormations as $formation) {
            $manager->persist($formation);
        }

            //ENTREPRISES
        $tabEntreprises = array();
        for ($i=0; $i < 10; $i++) {
            $entreprise = new Entreprise();
            $entreprise->setNom($faker->realText($maxNbChars = 20, $indexSize = 2))
                        ->setActivite($faker->realText($maxNbChars = 100, $indexSize = 2))
                        ->setAdresse($faker->address)
                        ->setSiteWeb($faker->realText($maxNbChars = 100, $indexSize = 2))
            ;

            array_push($tabEntreprises, $entreprise);
            $manager->persist($entreprise);
        }
        
            //STAGE
        for ($i=0; $i < 20; $i++) {
            $stage = new Stage();
            $stage->setTitre($faker->realText($maxNbChars = 30, $indexSize = 2))
                    ->setString($faker->realText($maxNbChars = 500, $indexSize = 2))
                    ->setCourielContact($faker->realText($maxNbChars = 20, $indexSize = 2))
            ;

            $entrep= $faker->randomElement($array = $tabEntreprises);
            $stage->setEntreprise($entrep);
            $entrep->addStage($stage);
            $manager->persist($entrep);
            $nbFormation = $faker->numberBetween($min = 1, $max = 3);

            for ($j=0; $j < $nbFormation; $j++) { 
                $stage->addFromation($tabFormations[$j]);
                $tabFormations[$j]->addStage($stage);
                $manager->persist($tabFormations[$j]);
            }

            $manager->persist($stage);   
        }

        $manager->flush();
    }
}
