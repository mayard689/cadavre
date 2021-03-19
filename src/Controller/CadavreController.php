<?php

namespace App\Controller;

use App\Repository\SentenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CadavreController extends AbstractController
{
    /**
     * @Route("/jeu", name="cadavre")
     */
    public function index(SentenceRepository $sentenceRepository): Response
    {
        return $this->render('cadavre/index.html.twig', [
            'sentences' => $sentenceRepository->findAll(),
        ]);
    }


}
