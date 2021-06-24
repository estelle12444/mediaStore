<?php

namespace App\Controller;

use App\Entity\ArticleIllustration;
use App\Form\ArticleIllustrationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleIllustrationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/article/illustration')]
class ArticleIllustrationController extends AbstractController
{
    #[Route('/', name: 'article_illustration_index', methods: ['GET'])]
    public function index(ArticleIllustrationRepository $articleIllustrationRepository): Response
    {
        return $this->render('article_illustration/index.html.twig', [
            'article_illustrations' => $articleIllustrationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'article_illustration_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $articleIllustration = new ArticleIllustration();
        $form = $this->createForm(ArticleIllustrationType::class, $articleIllustration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $IllustrationFile = $form->get('illustrationFile')->getData();
            if ($IllustrationFile) {
                $IllustrationName = pathinfo($IllustrationFile->getClientOriginalName(), PATHINFO_FILENAME);
                
                $newFilename = $IllustrationName.'-'.uniqid().'.'.$IllustrationFile->guessExtension();
                try {
                    $IllustrationFile->move(
                        $this->getParameter('Illustration_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $articleIllustration->setIllustrationName($newFilename);
            }
            
                $auteur=$this->getUser()->getId();
            $articleIllustration->setAuteur($auteur);
            $articleIllustration->setActive(True);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articleIllustration);
            $entityManager->flush();

            return $this->redirectToRoute('article_illustration_index');
        }

        return $this->render('article_illustration/new.html.twig', [
            'article_illustration' => $articleIllustration,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'article_illustration_show', methods: ['GET'])]
    public function show(ArticleIllustration $articleIllustration): Response
    {
        return $this->render('article_illustration/show.html.twig', [
            'article_illustration' => $articleIllustration,
        ]);
    }

    #[Route('/{id}/edit', name: 'article_illustration_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ArticleIllustration $articleIllustration): Response
    {
        $form = $this->createForm(ArticleIllustrationType::class, $articleIllustration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_illustration_index');
        }

        return $this->render('article_illustration/edit.html.twig', [
            'article_illustration' => $articleIllustration,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'article_illustration_delete', methods: ['POST'])]
    public function delete(Request $request, ArticleIllustration $articleIllustration): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articleIllustration->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articleIllustration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_illustration_index');
    }
}
