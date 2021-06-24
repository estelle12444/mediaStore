<?php

namespace App\Controller;

use App\Entity\ArticleImg;
use App\Form\ArticleImgType;
use App\Repository\ArticleImgRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/article/img')]
class ArticleImgController extends AbstractController
{
    #[Route('/', name: 'article_img_index', methods: ['GET'])]
    public function index(ArticleImgRepository $articleImgRepository): Response
    {
        return $this->render('article_img/index.html.twig', [
            'article_imgs' => $articleImgRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'article_img_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $articleImg = new ArticleImg();
        $form = $this->createForm(ArticleImgType::class, $articleImg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ImageFile = $form->get('imageFile')->getData();
            if ($ImageFile) {
                $filename = pathinfo($ImageFile->getClientOriginalName(), PATHINFO_FILENAME);
                
                $newFilename = $filename.'-'.uniqid().'.'.$ImageFile->guessExtension();
                try {
                    $ImageFile->move(
                        $this->getParameter('Images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $articleImg->setFilename($newFilename);
            }
            
                $auteur=$this->getUser()->getId();
            $articleImg->setAuteur($auteur);
            $articleImg->setActive(True);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articleImg);
            $entityManager->flush();

            return $this->redirectToRoute('article_img_index');
        }

        return $this->render('article_img/new.html.twig', [
            'article_img' => $articleImg,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'article_img_show', methods: ['GET'])]
    public function show(ArticleImg $articleImg): Response
    {
        return $this->render('article_img/show.html.twig', [
            'article_img' => $articleImg,
        ]);
    }

    #[Route('/{id}/edit', name: 'article_img_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ArticleImg $articleImg): Response
    {
        $form = $this->createForm(ArticleImgType::class, $articleImg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_img_index');
        }

        return $this->render('article_img/edit.html.twig', [
            'article_img' => $articleImg,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'article_img_delete', methods: ['POST'])]
    public function delete(Request $request, ArticleImg $articleImg): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articleImg->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articleImg);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_img_index');
    }
}
