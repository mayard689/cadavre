<?php

namespace App\Controller;

use App\Entity\Content;
use App\Repository\ContentRepository;
use App\Service\StatTagManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="sitemap", defaults={"_format"="xml"})
     */
    public function index(Request $request, ContentRepository $contentRepository, StatTagManager $tagManager): Response
    {
        $hostname = $request->getSchemeAndHttpHost();

        //add static url
        $urls[] = ['loc' => $this->generateUrl('home')];

        //add dynamic URL : content entities
        $contents = $contentRepository->findComming(-1,0);
        $images = [];
        foreach ($contents as $content) {
            $images[] = [
                'loc' => '/contentPicture/'.$content->getPicture(), // URL to image
                'title' => $content->getTitle()    // Optional, text describing the image
            ];

            //uses publicationdate unless an update has been made after the publication
            $date = $content->getDate();
            if ($content->getUpdatedAt() > $date) {
                $date = $content->getUpdatedAt();
            }

            $urls[] = [
                'loc' => $this->generateUrl('content_show', [
                    'slug' => $content->getSlug(),
                ]),
                'lastmod' => $date->format('Y-m-d'),
                'images' => $images
            ];
        }

        // Make the XML response
        $response = new Response(
            $this->renderView('sitemap/index.html.twig', ['urls' => $urls,
                'hostname' => $hostname]),
            200
        );

        // Add headers
        $response->headers->set('Content-Type', 'text/xml');

        // return
        return $response;
    }
}
