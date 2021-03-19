<?php

namespace App\Controller;

use App\Form\CustomerType;
use App\Repository\SentenceRepository;
use Doctrine\DBAL\Types\StringType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Valid;

class CadavreController extends AbstractController
{
    /**
     * @Route("/jeu", name="cadavre")
     */
    public function index(Request $request, SentenceRepository $sentenceRepository): Response
    {
        $form = $this->createFormBuilder([
            'chapter' => ""
        ])
        //add customer contact data
        ->add('chapter', null, [
            'label'=>'Hep là, dans quel chapitre veux tu écrire ?',
            'required'=>true,
            'constraints' => [

            ]
        ])
        //build form
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chapterCode = $form->getData()['chapter'];
            return $this->redirectToRoute('chapter', ["code" => $chapterCode]);
        }

        $formView = $form->createView();
        return $this->render('cadavre/chapterRequest.html.twig', [
            'form' => $formView
        ]);
    }

    /**
     * @Route("/jeu/chapitre/{code}", name="chapter")
     */
    public function paragraph(String $code, SentenceRepository $sentenceRepository): Response
    {
        return $this->render('cadavre/index.html.twig', [
            'sentences' => $sentenceRepository->findBy(array("chapter" => $code)),
        ]);
    }

}
