<?php

namespace App\Controller;
use App\Entity\Personnalisation;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PersonnalisationType;
use App\Entity\ArticleIllustration;
use App\Entity\ArticleImg;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ArticleVideo;
use App\Entity\ArticleVoix;
use App\Form\SearchImageType;
use App\Repository\ArticleImgRepository;
use App\Repository\ArticleVoixRepository;
use App\Repository\ArticleVideoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleIllustrationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, ArticleImgRepository $articleImgRepository,ArticleVideoRepository $articleVideoRepository,ArticleIllustrationRepository $articleIllustrationRepository,ArticleVoixRepository $articleVoixRepository): Response
    {
       

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'article_imgs' => $articleImgRepository->LastFree(),
            'article_videos' => $articleVideoRepository->LastFree(),
            'article_illustrations' => $articleIllustrationRepository->LastFree(),
            'article_voixes' => $articleVoixRepository->LastFree(),
            
        ]);
    }

    #[Route('/photographie', name: 'photographie')]
    public function photographie(ArticleImgRepository $articleImgRepository,Request $request ): Response
    {
        $articleImage =$articleImgRepository->findBy(['active'=>true], ['date_de_creation'=> 'desc'],5);
        
        $form = $this->createForm(SearchImageType::class);

        $search = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $articleImage = $articleImgRepository->Search($search->get('mots')->getData());
        }
        return $this->render('home/photographie.html.twig', [
            'article_imgs' => $articleImage,
            'form'=> $form-> createView(),
        ]);
    }

   
    #[Route('/videographie', name: 'videographie')]
    public function videographie(Request $request ,ArticleVideoRepository $articleVideoRepository): Response
    {
        $articleVideo =$articleVideoRepository->findBy(['active'=>true], ['date_de_creation'=> 'desc'],5);
        
        $form = $this->createForm(SearchImageType::class);

        $SearchVideo = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $articleVideo = $articleVideoRepository->SearchVideo($SearchVideo->get('mots')->getData());
        }


        return $this->render('home/videographie.html.twig', [
            'article_videos' => $articleVideo,
            'form'=> $form-> createView(),
        ]);
    }

    #[Route('/illustration', name: 'illustration')]
    public function illustration(Request $request, ArticleIllustrationRepository $articleIllustrationRepository): Response
    {

        $articleIllustration =$articleIllustrationRepository->findBy(['active'=>true], ['date_de_creation'=> 'desc'],5);
        
        $form = $this->createForm(SearchImageType::class);

        $SearchIllustration = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $articleIllustration = $articleIllustrationRepository->SearchIllustration($SearchIllustration->get('mots')->getData());
        }
        return $this->render('home/illustration.html.twig',[
            'article_illustrations' => $articleIllustration,
            'form'=> $form-> createView()
        ]);

    }

    #[Route('/voixOff', name: 'voixOff')]
    public function voixOff(Request $request, ArticleVoixRepository $articleVoixRepository): Response
    {

        $articleVoix =$articleVoixRepository->findBy(['active'=>true], ['date_de_creation'=> 'desc'],5);
        
        $form = $this->createForm(SearchImageType::class);

        $SearchVoix = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $articleVoix = $articleVoixRepository->SearchVoix($SearchVoix->get('mots')->getData());
        }

        return $this->render('home/voixOff.html.twig', [
            'article_voixes' => $articleVoix,
            'form'=> $form-> createView()
        ]);
    }

    #[Route('/personnalisation', name: 'personnalisation')]
    public function personnalisation(Request $request, EntityManagerInterface $entityManagerInterface)
    {
        $personnaliser = new Personnalisation();
        $form = $this->createForm(PersonnalisationType::class, $personnaliser);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($personnaliser);
            $entityManagerInterface->flush();
            $this->addFlash('info', "votre message a été envoyé. Nous vous répondrons dans quelques instants");

            $nom=$this->getUser()->getPrenom();
            $personnaliser->setNom($nom);
        }
        

        return $this->render('home/personnalisation.html.twig', [
            'formPersonnaliser' => $form->createView()
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig');
    }
    
}
