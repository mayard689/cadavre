<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Entity\Sentence;
use App\Form\SentenceType;
use App\Repository\ChapterRepository;
use App\Repository\SentenceRepository;
use App\Service\StatTagManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CadavreController extends AbstractController
{
    /**
     * @Route("/jeu", name="cadavre")
     */
    public function setChapterCode(Request $request, SentenceRepository $sentenceRepository): Response
    {
        $form = $this->createFormBuilder([
            'chapter' => ""
        ])
        //add customer contact data
        ->add('chapter', null, [
            'label'=>'Ton code (magique de préférence) :',
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
    public function addSentence(
        String $code, Request $request,
        SentenceRepository $sentenceRepository,
        ChapterRepository $chapterRepository,
        StatTagManager $tagManager
    ): Response {
        //record a tag while loading this page
        $tagManager->addTag("cadavrePageLoading-".$code);

        if($code == "notReady") {
            return $this->render('cadavre/notReady.html.twig');
        }

        //get the corresponding chapter
        $chapter = $chapterRepository->findOneBy(['code' => $code]);

        if (!$chapter) {
            $this->addFlash('danger', 'Un nuage rouge apparait et vous comprenez que le code que vous avez trouvé n\'est pas le bon.');
            return $this->redirectToRoute('cadavre');
        }

        // manage new sentence
        $sentence = new Sentence();
        $sentence->setChapter($chapter);
        $form = $this->createForm(SentenceType::class, $sentence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sentence);
            $entityManager->flush();

            $this->addFlash('success', 'Une poule verte traverse le chemin et vous fait savoir que votre merveilleuse idée est entrée dans le grand mécanisme. Cot\' Cot\' Cot\' ');

            return $this->redirectToRoute('cadavre');
        }

        $formView = $form->createView();

        //manage previously entered sentences
        $sentenceList = $sentenceRepository->findBy(array("chapter" => $chapter), array('id' => 'DESC'), 2);
        $sentenceList = array_reverse($sentenceList);

        return $this->render('cadavre/index.html.twig', [
            'sentences' => $sentenceList,
            'sentence' => $sentence,
            'chapter' => $chapter,
            'form' => $formView,
        ]);
    }

    /**
     * @Route("/jeu/final", name="final")
     */
    public function getGlobalText(
        SentenceRepository $sentenceRepository,
        ChapterRepository $chapterRepository,
        StatTagManager $tagManager
    ): Response {
        //record a tag while loading this page
        $tagManager->addTag("finalCadavrePageLoading");

        //manage previously entered sentences
        $sentenceList = $sentenceRepository->findBy([], array('chapter' => 'ASC'));

        $sentencesByChapter = [];
        foreach($sentenceList as $sentence) {
            $sentencesByChapter[$sentence->getChapter()->getId()][] = $sentence;
        }

        $chapters = $chapterRepository->findBy([], array('id' => 'ASC'));

        return $this->render('cadavre/final.html.twig', [
            'sentencesByChapter' => $sentencesByChapter,
            'chapters' => $chapters,
        ]);
    }
}
