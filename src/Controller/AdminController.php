<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function userdata(): Response
    {
        
        return $this->render('admin/userdata.html.twig');
        
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


}
