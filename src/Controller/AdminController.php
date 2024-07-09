<?php

namespace App\Controller;
use App\Form\ArticleImgType;
use App\Entity\ArticleImg;
use App\Repository\ArticleImgRepository;
use App\Repository\ArticleVideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/admin")
 * @package App\Controller\Admin
 */
class AdminController extends AbstractController
{
    #[Route('/', name: 'admin')]
    public function index(): Response
    {
        
        return $this->render('admin/index.html.twig');
        
    }

    #[Route('/statistique', name: 'statistique')]
    public function statistique(): Response
    {
        
        return $this->render('admin/statistique.html.twig');
        
    }

    #[Route('/userdata', name: 'userdata')]
    public function userdata( UserRepository $userRepository): Response
    {
        
        return $this->render('admin/userdata.html.twig',[
            'controller_name' => 'HomeController',
            'user' => $userRepository->findAll()
        ]);
        
    }

    #[Route('/imagedata', name: 'imagedata')]
    public function imagedata(): Response
    {
        
        return $this->render('admin/imagedata.html.twig');
        
    }

    #[Route('/illustrationdata', name: 'illustrationdata')]
    public function illustrationdata(): Response
    {
        
        return $this->render('admin/illustrationdata.html.twig');
        
    }

    #[Route('/voixOffdata', name: 'voixOffdata')]
    public function voixOffdata(): Response
    {
        
        return $this->render('admin/voixOffdata.html.twig');
        
    }

    #[Route('/commandeArticle', name: 'commandeArticle')]
    public function commandeArticle(): Response
    {
        
        return $this->render('admin/commandeArticle.html.twig');
        
    }
    
    #[Route('/listArticle', name: 'listArticle',)]
    public function listArticle(ArticleImgRepository $articleImgRepository,ArticleVideoRepository $articleVideoRepository): Response
    {
        
        return $this->render('admin/listArticle.html.twig', [
            'article_imgs' => $articleImgRepository->findAll(),
            'article_videos' => $articleVideoRepository->findAll()
        ]);
        
    }

     #[Route('/editArticle', name: 'editArticle', methods: ['GET', 'POST'])]
    public function editArticle(Request $request, ArticleImg $articleImg, ArticleImgRepository $articleImgRepository,ArticleVideoRepository $articleVideoRepository): Response
    {
         $form = $this->createForm(ArticleImgType::class, $articleImg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('listArticle');
        }

        return $this->render('admin/editArticle.html.twig', [
            'article_imgs' => $articleImgRepository->findAll(),
            'article_videos' => $articleVideoRepository->findAll(),
            'form' => $form->createView()
        ]);
        
    }


}
