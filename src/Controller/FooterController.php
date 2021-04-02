<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FooterController extends AbstractController
{
    /**
     * @Route("/mentions-legales", name="legal")
     */
    public function legal()
    {
         return $this->render('footer/legal.html.twig');
    }

    /**
     * @Route("/protection-des-donnees", name="dataProtection")
     */
    public function data()
    {
        return $this->render('footer/dataProtection.html.twig');
    }
}
