<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Histogram;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\LineChart;
use \DateTime;

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
            //action for update here
            $commande = "Previous";
        } else if (isset($_POST['after'])) {
            //action for delete
            $commande = "After";
        } else {
            //invalid action!
            $commande = "None";
        }

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [
                ['Language', 'Speakers (in millions)'],
                ['German',  5.85],
                ['French',  1.66],
                ['Italian', 0.316],
                ['Romansh', 0.0791]
            ]
        );
        $pieChart->getOptions()->setPieSliceText('label');
        $pieChart->getOptions()->setTitle('Swiss Language Use (100 degree rotation)');
        $pieChart->getOptions()->setPieStartAngle(100);
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getLegend()->setPosition('none');

        $histogram = new Histogram();
        $histogram->getData()->setArrayToDataTable([
            ['Population'],
            [12000000],
            [13000000],
            [100000000],
            [1000000000],
            [25000000],
            [600000],
            [6000000],
            [65000000],
            [210000000],
            [80000000],
        ]);
        $histogram->getOptions()->setTitle('Country Populations');
        $histogram->getOptions()->setWidth(900);
        $histogram->getOptions()->setHeight(500);
        $histogram->getOptions()->getLegend()->setPosition('none');
        $histogram->getOptions()->setColors(['#e7711c']);
        $histogram->getOptions()->getHistogram()->setLastBucketPercentile(10);
        $histogram->getOptions()->getHistogram()->setBucketSize(10000000);

        $lineChart = new LineChart();
        $lineChart->getData()->setArrayToDataTable([
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

        $lineChart->getOptions()->getChart()
            ->setTitle('Average Temperatures and Daylight in Iceland Throughout the Year');
        $lineChart->getOptions()
            ->setHeight(400)
            ->setWidth(900)
            ->setSeries([['axis' => 'Temps'], ['axis' => 'Daylight']])
            ->setAxes(['y' => ['Temps' => ['label' => 'Temps (Celsius)'], 'Daylight' => ['label' => 'Daylight']]]);

        return $this->render('/blog/dashboard.html.twig', [
            'commande' => $commande,
            'piechart' => $pieChart,
            'histogram' => $histogram,
            'linechart' => $lineChart
        ]);
    }

}
