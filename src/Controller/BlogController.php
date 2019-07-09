<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Histogram;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\LineChart;
use \DateTime;
use App\Entity\Consommation;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'title' => "Bienvenue ici les amis !",
            'age' => 9
        ]);
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        if (isset($_POST['previous'])) {
            //action for previous
            $commande = "Previous";
            $jourUnixMax = $_POST['dateMax'];
            $jourUnixMin = $_POST['dateMin'];
            $jourUnixMax = $jourUnixMax - ( 7 * 86400);
            $jourUnixMin = $jourUnixMin - ( 7 * 86400);
        } else if (isset($_POST['after'])) {
            //action for after
            $commande = "After";
            $jourUnixMax = $_POST['dateMax'];
            $jourUnixMin = $_POST['dateMin'];
            $jourUnixMax = $jourUnixMax + ( 7 * 86400);
            $jourUnixMin = $jourUnixMin + ( 7 * 86400);
        } else {
            // Premier affichage du dashboard
            // Nous sommes le (pour le dev, nous sommes le 8 mai 2019)
            $jourUnixMax = 1556668800 + ( 7 * 86400);
            //$jourUnixMax = strtotime('2019-05-1 00:00:00');
            $jourUnixMin = $jourUnixMax - ( 7 * 86400 );
            $commande = "$jourUnixMax : $jourUnixMin";
        }

        $consommation = $this->getDoctrine()->getRepository(Consommation::class)->findByDateRange($jourUnixMin, $jourUnixMax);

        $head[] = ['Month', 'Consommation moyenne en Kw', 'Température moyenne extérieure'];
        foreach($consommation as $conso){
            $head[] = [ $conso['createdAt'], $conso['kw'], $conso['kwh'] ];
        }

        //print_r($head);
        $lineChart = new LineChart();
        $lineChart->getData()->setArrayToDataTable(
            $head
        );
        $lineChart->getOptions()->getChart()
            ->setTitle('Consommation électrique hebdomadaire - Température extérieur');
        $lineChart->getOptions()
            ->setHeight(600)
            ->setWidth(1800)
            ->setSeries([['axis' => 'Kw'], ['axis' => 'Temps']])
            ->setAxes(['y' => ['Kw' => ['label' => 'Consommation (Kw)'], 'Temps' => ['label' => 'Température (°C)']]]);

        return $this->render('/blog/dashboard.html.twig', [
            'commande' => $commande,
            'dateMin' => $jourUnixMin,
            'dateMax' => $jourUnixMax,
//            'piechart' => $pieChart,
//            'histogram' => $histogram,
            'linechart' => $lineChart
        ]);
    }

}
