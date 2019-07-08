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
            // Nous sommes le (pour le dev, nous sommes le 1 mai 2019)
            $jourUnixMax = 1556668800;
            //$jourUnixMax = strtotime('2019-05-1 00:00:00');
            $jourUnixMin = $jourUnixMax - ( 7 * 86400 );
            $commande = "$jourUnixMax : $jourUnixMin";
        }

        $consommation = $this->getDoctrine()->getRepository(Consommation::class)->findByDateRange($jourUnixMin, $jourUnixMax);

        $lineChart = new LineChart();
/*        $lineChart->getData()->setArrayToDataTable([
            ['Month', 'Average Temperature', 'Average Hours of Daylight'],
            [new DateTime('2014-01'),  -.5,  5.7],
            [new DateTime('2014-02'),   .4,  8.7],
            [new DateTime('2014-03'),   .5,   12],
            [new DateTime('2014-04'),  2.9, 15.3],
            [new DateTime('2014-05'),  6.3, 18.6],
            [new DateTime('2014-06'),    9, 20.9],
            [new DateTime('2014-07'), 10.6, 19.8],
            [new DateTime('2014-08'), 10.3, 16.6],
            [new DateTime('2014-09'),  7.4, 13.3],
            [new DateTime('2014-10'),  4.4,  9.9],
            [new DateTime('2014-11'), 1.1,  6.6],
            [new DateTime('2014-12'), -.2,  4.5]
        ]);
*/        
        $head[] = ['Month', 'Average Temperature', 'Average Hours of Daylight'];
        foreach($consommation as $conso){
            $head[] = [ $conso['createdAt'], $conso['kw'], $conso['kwh'] ];
        }
        //$head[] = $consommation;
        //$graph[] = array_merge($head, $consommation);
        print_r($head);
        $lineChart->getData()->setArrayToDataTable(
            $head
        );

        $lineChart->getOptions()->getChart()
            ->setTitle('Average Temperatures and Daylight in Iceland Throughout the Year');
        $lineChart->getOptions()
            ->setHeight(400)
            ->setWidth(900)
            ->setSeries([['axis' => 'Temps'], ['axis' => 'Daylight']])
            ->setAxes(['y' => ['Temps' => ['label' => 'Temps (Celsius)'], 'Daylight' => ['label' => 'Daylight']]]);

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
