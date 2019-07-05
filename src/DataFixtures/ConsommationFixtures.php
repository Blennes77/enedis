<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Consommation;
use Faker;

class ConsommationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Création d'un jeu de données à interval de 30mn sur 2 mois à partir du 1 mai 2019 (1556668800)
        $jourUnix = 1556668800;

        $faker = Faker\Factory::create('fr_FR');
        // Génération des données pour le moi de mai 2019 et juin 2019 soit 61 jours
        for($jour = 1; $jour <= 61; $jour++){
            // On a 1440 mn par tranche de 24h, que l'on découpe en 48 portion de 30mn (1800s)
            for($i = 0 ; $i <= 47; $i++){
                $date = new \DateTime("@$jourUnix");
                $consommation = new Consommation();
                $consommation->setCreatedAt($date);
                $kw = $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 50);
                $consommation->setKw($kw);
                $consommation->setKwh($kw/2);

                $manager->persist($consommation);
                
                // On commit par paquet de 50
                if(fmod($i, 50) == 0){
                    $manager->flush();
                }

                // On se positionne sur l'incrément suivant
                $jourUnix = $jourUnix + 1800 ;
            }

        }
  
        // Commit du dernier paquet
        $manager->flush();
    }
}
