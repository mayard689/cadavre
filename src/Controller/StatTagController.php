<?php

namespace App\Controller;

use App\Entity\StatTag;
use App\Form\StatTagType;
use App\Repository\StatTagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/stat/tag")
 */
class StatTagController extends AbstractController
{
    /**
     * @Route("/", name="stat_tag_index", methods={"GET"})
     */
    public function index(StatTagRepository $statTagRepository): Response
    {
        return $this->render('stat_tag/index.html.twig', [
            'stat_tags' => $statTagRepository->findBy([],array('id'=>"DESC")),
        ]);
    }

    /**
     * @Route("/new", name="stat_tag_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $statTag = new StatTag();
        $form = $this->createForm(StatTagType::class, $statTag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($statTag);
            $entityManager->flush();

            return $this->redirectToRoute('stat_tag_index');
        }

        return $this->render('stat_tag/new.html.twig', [
            'stat_tag' => $statTag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stat_tag_show", methods={"GET"})
     */
    public function show(StatTag $statTag): Response
    {
        return $this->render('stat_tag/show.html.twig', [
            'stat_tag' => $statTag,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="stat_tag_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, StatTag $statTag): Response
    {
        $form = $this->createForm(StatTagType::class, $statTag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stat_tag_index');
        }

        return $this->render('stat_tag/edit.html.twig', [
            'stat_tag' => $statTag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stat_tag_delete", methods={"DELETE"})
     */
    public function delete(Request $request, StatTag $statTag): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statTag->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($statTag);
            $entityManager->flush();
        }

        return $this->redirectToRoute('stat_tag_index');
    }
}
