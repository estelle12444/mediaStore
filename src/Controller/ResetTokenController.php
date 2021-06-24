<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResetTokenController extends AbstractController
{
    #[Route('/reset/token', name: 'reset_token')]
    public function index(): Response
    {
        return $this->render('reset_token/index.html.twig', [
            'controller_name' => 'ResetTokenController',
        ]);
    }
}
