<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/profil")
 * @package App\Controller\Profil
 */
class ProfilController extends AbstractController
{
    #[Route('/', name: 'profil')]
    public function index()
    {
        
        return $this->render('profil/index.html.twig');
    }

    #[Route('/commandeArticle', name: 'commandeArticle')]
    public function commandeArticle()
    {
        
        return $this->render('profil/commandeArticle.html.twig');
    }

    #[Route('/Oeuvres', name: 'Oeuvres')]
    public function Oeuvres()
    {
        
        return $this->render('profil/Oeuvres.html.twig');
    }


   
    

}
