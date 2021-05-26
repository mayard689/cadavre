<?php

namespace App\Controller;

use App\Service\MeteoCH;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    /**
     * @Route("/meteo", name="weather")
     */
    public function currentWeather(MeteoCH $meteoCH)
    {
        $weatherData = $meteoCH->getWeather();

        $iconURL = null;
        if($weatherData) {
            $iconURL = $meteoCH->getCurrentIcon($weatherData);
        }

        return $this->render('weather/_weatherWidget.html.twig', [
            'iconURL' => $iconURL,
        ]);
    }
}
