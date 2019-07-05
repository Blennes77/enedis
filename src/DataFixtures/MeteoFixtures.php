<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Meteo;
use Faker;

class MeteoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Création d'un jeu de données à interval de 6mn sur 2 mois à partir du 1 mai 2019 (1556668800)
        $jourUnix = 1556668800;

        $faker = Faker\Factory::create('fr_FR');
        // Génération des données pour le moi de mai 2019 et juin 2019 soit 61 jours
        for($jour = 1; $jour <= 61; $jour++){
            // On a 1440 mn par tranche de 24h, que l'on découpe en 240 portion de 6mn (360s)
            for($i = 0 ; $i <= 239; $i++){
                $date = new \DateTime("@$jourUnix");
                $meteo = new Meteo();
                $meteo->setCreatedAt($date);
                $meteo->setTemperature($faker->randomFloat($nbMaxDecimals = 2, $min = -10, $max = 30 ));
                $meteo->setPressure($faker->numberBetween($min = 700, $max = 1100));
                $meteo->setTemperatureMin($faker->randomFloat($nbMaxDecimals = 2, $min = -10, $max = 30));
                $meteo->setTemperatureMax($faker->randomFloat($nbMaxDecimals = 2, $min = -10, $max = 30));
                $meteo->setHumidity($faker->numberBetween($min = 30, $max = 90));
                $meteo->setWindSpeed($faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 20));
                $meteo->setWindDirection($faker->numberBetween($min = 0, $max = 360));

                $manager->persist($meteo);
                
                // On commit par paquet de 50
                if(fmod($i, 50) == 0){
                    $manager->flush();
                }

                // On se positionne sur l'incrément suivant
                $jourUnix = $jourUnix + 360 ;
            }

        }
  
        // Commit du dernier paquet
        $manager->flush();
    }
}
