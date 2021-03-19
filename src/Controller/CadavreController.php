<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CadavreController extends AbstractController
{
    /**
     * @Route("/cadavre", name="cadavre")
     */
    public function index(): Response
    {
        return $this->render('cadavre/index.html.twig', [
            'controller_name' => 'CadavreController',
        ]);
    }
}
