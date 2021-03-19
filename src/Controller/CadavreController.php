<?php

namespace App\Controller;

use App\Entity\Sentence;
use App\Form\CustomerType;
use App\Form\SentenceType;
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
            'constraints' => []
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
    public function paragraph(String $code, Request $request, SentenceRepository $sentenceRepository): Response
    {
        // manage new sentence
        $sentence = new Sentence();
        $sentence->setChapter($code);
        $form = $this->createForm(SentenceType::class, $sentence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sentence);
            $entityManager->flush();

            return $this->redirectToRoute('cadavre');
        }

        $formView = $form->createView();

        //manage previously entered sentences
        $sentenceList = $sentenceRepository->findBy(array("chapter" => $code), array('id' => 'DESC'), 2);
        $sentenceList = array_reverse($sentenceList);

        return $this->render('cadavre/index.html.twig', [
            'sentences' => $sentenceList,
            'sentence' => $sentence,
            'form' => $formView,
        ]);
    }

    /**
     * @Route("/jeu/final", name="final")
     */
    public function final(SentenceRepository $sentenceRepository): Response
    {
        //manage previously entered sentences
        $sentenceList = $sentenceRepository->findBy([], array('chapter' => 'ASC'));

        $sentencesByChapter = [];
        foreach($sentenceList as $sentence) {
            $sentencesByChapter[$sentence->getChapter()][] = $sentence;
        }

        return $this->render('cadavre/final.html.twig', [
            'sentencesByChapter' => $sentencesByChapter,
        ]);
    }
}
