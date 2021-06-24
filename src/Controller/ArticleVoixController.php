<?php

namespace App\Controller;

use App\Entity\ArticleVoix;
use App\Form\ArticleVoixType;
use App\Repository\ArticleVoixRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/article/voix')]
class ArticleVoixController extends AbstractController
{
    #[Route('/', name: 'article_voix_index', methods: ['GET'])]
    public function index(ArticleVoixRepository $articleVoixRepository): Response
    {
        return $this->render('article_voix/index.html.twig', [
            'article_voixes' => $articleVoixRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'article_voix_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $articleVoix = new ArticleVoix();
        $form = $this->createForm(ArticleVoixType::class, $articleVoix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $voixFile = $form->get('voixFile')->getData();
            if ($voixFile) {
                $voixName = pathinfo($voixFile->getClientOriginalName(), PATHINFO_FILENAME);
                
                $newFilename = $voixName.'-'.uniqid().'.'.$voixFile->guessExtension();
                try {
                    $voixFile->move(
                        $this->getParameter('VoixOff_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $articleVoix->setVoixName($newFilename);
            }
            
                $auteur=$this->getUser()->getId();
            $articleVoix->setAuteur($auteur);
            $articleVoix->setActive(True);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articleVoix);
            $entityManager->flush();

            return $this->redirectToRoute('article_voix_index');
        }

        return $this->render('article_voix/new.html.twig', [
            'article_voix' => $articleVoix,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'article_voix_show', methods: ['GET'])]
    public function show(ArticleVoix $articleVoix): Response
    {
        return $this->render('article_voix/show.html.twig', [
            'article_voix' => $articleVoix,
        ]);
    }

    #[Route('/{id}/edit', name: 'article_voix_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ArticleVoix $articleVoix): Response
    {
        $form = $this->createForm(ArticleVoixType::class, $articleVoix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_voix_index');
        }

        return $this->render('article_voix/edit.html.twig', [
            'article_voix' => $articleVoix,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'article_voix_delete', methods: ['POST'])]
    public function delete(Request $request, ArticleVoix $articleVoix): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articleVoix->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articleVoix);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_voix_index');
    }
}
