<?php

namespace App\Controller;

use App\Entity\ArticleVoix;
use App\Repository\ArticleIllustrationRepository;
use App\Services\Cart\CartService;

use App\Repository\ArticleImgRepository;
use App\Repository\ArticleVideoRepository;
use App\Repository\ArticleVoixRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index(SessionInterface $session, ArticleImgRepository $articleImgRepository,ArticleVoixRepository $articleVoixRepository,ArticleIllustrationRepository $articleIllustrationRepository, ArticleVideoRepository $articleVideoRepository)
    {
        $panier = $session ->get('panier', []);
        $panierWithData =[];
        foreach($panier as $id => $quantity){
            $panierWithData[] =[
                'article_img' => $articleImgRepository->find($id),
                'quantity' => $quantity,

            ]; 
        }

        $total =0;
        foreach($panierWithData as $item){
            $totalItem = $item['article_img']->getPrix()  ;
            $total += $totalItem;
        }
       
        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
            'items'=> $panierWithData,
            'total'=> $total
        ]);
    }


    #[Route('/panier/add/{id}', name: 'card_add')]
    public function add($id ,ArticleVoixRepository $articleVoixRepository,ArticleIllustrationRepository $articleIllustrationRepository, ArticleVideoRepository $articleVideoRepository,ArticleImgRepository $articleImgRepository,CartService $cartService)
    {
        $cartService ->add($id);
        return $this-> redirectToRoute("panier");

    }


    #[Route('/panier/remove/{id}', name: 'card_remove')]
    public function remove($id ,ArticleVoixRepository $articleVoixRepository,ArticleIllustrationRepository $articleIllustrationRepository, ArticleVideoRepository $articleVideoRepository,ArticleImgRepository $articleImgRepository, CartService $cartService)
    {
       
        $cartService ->remove($id);
        return $this-> redirectToRoute("panier");

    }

    #[Route('/commande', name: 'commande_final')]
    public function commande_final(): Response
    {
        return $this->render('panier/commande_final.html.twig');
        
    }

    #[Route('/visa', name: 'card_visa')]
    public function card_visa(): Response
    {
        return $this->render('panier/visa.html.twig');
        
    }
   
}
