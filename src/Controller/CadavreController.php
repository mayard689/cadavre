<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Entity\Sentence;
use App\Form\SentenceType;
use App\Form\SmallSentenceType;
use App\Repository\ChapterRepository;
use App\Repository\SentenceRepository;
use App\Service\StatTagManager;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
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
        StatTagManager $tagManager,
        SessionInterface $session,
        MailerInterface $mailer
    ): Response {
        //record a tag while loading this page
        $tagManager->addTag("cadavrePageLoading-".$code);

        //in case the code is "not ready" tell that the game is not started
        if($code == "notReady") {
            return $this->render('cadavre/notReady.html.twig');
        }

        //get the corresponding chapter
        $chapter = $chapterRepository->findOneBy(['code' => $code]);

        //in case the chapter code does not exists
        if (!$chapter) {
            $this->addFlash('danger', 'Un nuage rouge apparait et vous comprenez que le code que vous avez trouvé n\'est pas le bon.');
            return $this->redirectToRoute('home');
        }

        //manage previously entered sentences
        $sentenceList = $sentenceRepository->findBy(array("chapter" => $chapter), array('previous' => 'DESC', 'id' => 'ASC'), 1);
        //var_dump($sentenceList);exit();
        //get the lastSentence if exists
        $lastSentence = null;
        if (isset($sentenceList[0])) {
            $lastSentence = $sentenceList[0];
        };

        $pseudo = '';
        if (!is_null($session->get('pseudo'))) {
            $pseudo = $session->get('pseudo');
        }

        $form = $this->createForm(SmallSentenceType::class, [
            'text' => '',
            'previous' => $lastSentence->getSecret(),
            'pseudo' => $pseudo
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sentenceData = $form->getData();

            //get previous sentence from its secret
            $previousSentence = $sentenceRepository->findOneBy(['secret'=>$sentenceData['previous']]);

            //in case previous sentence cannot be found
            if (!$previousSentence) {
                $this->addFlash('danger', 'Nous n\'arrivons pas à trouver à quelle phrase votre proposition fait suite...');
                return $this->redirectToRoute('home');
            }

            //store pseudo to session
            $session->set('pseudo', $sentenceData['pseudo']);

            // manage new sentence
            $sentence = new Sentence();
            $sentence->setText($sentenceData['text']);
            $sentence->setPseudo($sentenceData['pseudo']);
            $sentence->setPrevious($previousSentence);
            $sentence->setChapter($previousSentence->getChapter());
            //make $s a random string
            for ($secret = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 10; $x = rand(0,$z), $secret .= $a{$x}, $i++);
            $sentence->setSecret($secret);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sentence);
            $entityManager->flush();

            //send email to cdf
            $adminEmail = $this->getParameter("admin_email");
            $email = (new TemplatedEmail())
                ->from($this->getParameter("mailer_from"))
                ->subject('Une nouvelle contribution dans le cadavre exquis')
                ->to($adminEmail)
                ->htmlTemplate('email/contact.html.twig')
                ->context([
                    'name' => $sentenceData['pseudo'],
                    'from' => "cadavre exquis",
                    'message' => "suit ".$previousSentence->getId()." du chapitre ".$previousSentence->getChapter()->getNumber()." : ". $sentenceData['text'],
                ]);

            $mailer->send($email);

            $this->addFlash('success', 'Une poule verte traverse le chemin et vous fait savoir que votre merveilleuse idée est entrée dans le grand mécanisme. Cot\' Cot\' Cot\' ');

            return $this->redirectToRoute('home');
        }

        $formView = $form->createView();

        return $this->render('cadavre/index.html.twig', [
            'previous' => $lastSentence,
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
        $sentenceList = $sentenceRepository->findBy([], array('chapter' => 'ASC', 'previous' => 'ASC'));
        //$sentenceList = $sentenceRepository->findBy(array("chapter" => $chapter), array('previous' => 'DESC', 'id' => 'ASC'), 1);

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
