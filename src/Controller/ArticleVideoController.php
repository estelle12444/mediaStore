<?php

namespace App\Controller;

use App\Entity\ArticleVideo;
use App\Form\ArticleVideoType;
use App\Repository\ArticleVideoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/article/video')]
class ArticleVideoController extends AbstractController
{
    #[Route('/', name: 'article_video_index', methods: ['GET'])]
    public function index(ArticleVideoRepository $articleVideoRepository): Response
    {
        return $this->render('article_video/index.html.twig', [
            'article_videos' => $articleVideoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'article_video_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $articleVideo = new ArticleVideo();
        $form = $this->createForm(ArticleVideoType::class, $articleVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $VideoFile = $form->get('videoFile')->getData();
            if ($VideoFile) {
                $videoName = pathinfo($VideoFile->getClientOriginalName(), PATHINFO_FILENAME);
                
                $newFilename = $videoName.'-'.uniqid().'.'.$VideoFile->guessExtension();
                try {
                    $VideoFile->move(
                        $this->getParameter('Video_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $articleVideo->setVideoName($newFilename);
            }
            
                $auteur=$this->getUser()->getId();
            $articleVideo->setAuteur($auteur);
            $articleVideo->setActive(True);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articleVideo);
            $entityManager->flush();

            return $this->redirectToRoute('article_video_index');
        }

        return $this->render('article_video/new.html.twig', [
            'article_video' => $articleVideo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'article_video_show', methods: ['GET'])]
    public function show(ArticleVideo $articleVideo): Response
    {
        return $this->render('article_video/show.html.twig', [
            'article_video' => $articleVideo,
        ]);
    }

    #[Route('/{id}/edit', name: 'article_video_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ArticleVideo $articleVideo): Response
    {
        $form = $this->createForm(ArticleVideoType::class, $articleVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_video_index');
        }

        return $this->render('article_video/edit.html.twig', [
            'article_video' => $articleVideo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'article_video_delete', methods: ['POST'])]
    public function delete(Request $request, ArticleVideo $articleVideo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articleVideo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articleVideo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_video_index');
    }
}
