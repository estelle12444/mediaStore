<?php

namespace App\Controller;

use App\Entity\ArticleImg;
use App\Entity\ArticleVoix;
use App\Entity\ArticleVideo;
use App\Entity\ArticleIllustration;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AffichageController extends AbstractController
{
    #[Route('/affichage', name: 'affichage')]
    public function index()
    {
    }

    #[Route('/image/{id}', name: 'image_show')]
    public function image_show($id): Response
    {
        
        $repo = $this->getDoctrine()->getRepository(ArticleImg::class);
        $articleImg = $repo->find($id);

        if(!$articleImg){
            return $this->redirectToRoute('home');
        }
        return $this->render('Affichage/photo.html.twig',[
            'article_img'=> $articleImg
            
        ]);
    }

    #[Route('/video/{id}', name: 'video_show')]
    public function video_show($id): Response
    {
        
        $repo = $this->getDoctrine()->getRepository(ArticleVideo::class);
        $articlevideo = $repo->find($id);

        if(!$articlevideo){
            return $this->redirectToRoute('home');
        }
        return $this->render('Affichage/video.html.twig',[
            'article_video'=> $articlevideo
            
        ]);
    }
    #[Route('/illustration/{id}', name: 'illustration_show')]
    public function illustration_show($id): Response
    {
        
        $repo = $this->getDoctrine()->getRepository(ArticleIllustration::class);
        $articleIllustration = $repo->find($id);

        if(!$articleIllustration){
            return $this->redirectToRoute('home');
        }
        return $this->render('Affichage/illustration.html.twig',[
            'article_illustration'=> $articleIllustration
            
        ]);
    }
    #[Route('/voixOff/{id}', name: 'voixOff_show')]
    public function voixOff_show($id): Response
    {
        
        $repo = $this->getDoctrine()->getRepository(ArticleVoix::class);
        $articleVoix = $repo->find($id);

        if(!$articleVoix){
            return $this->redirectToRoute('home');
        }
        return $this->render('Affichage/voixOff.html.twig',[
            'article_voix'=> $articleVoix
            
        ]);
    }

}
