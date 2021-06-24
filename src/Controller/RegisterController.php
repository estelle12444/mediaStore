<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetTokenType;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class RegisterController extends AbstractController
{
    private function generateToken()
    {
        return rtrim(strtr(base64_encode(random_bytes(length: 32)), '+/', '-_'));
    }

    #[Route('/register', name: 'register')]
    public function index(Request $request,EntityManagerInterface $entityManagerInterface,  UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $encoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setToken($this->generateToken());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $message = (new \Swift_Message('AFRICASTOCK'))
                ->setFrom('bandamapascale@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                        // templates/emails/registration.html.twig
                        'emails/signup.html.twig',
                        ['token' => $user->getToken()]
                    ),
                    'text/html'
                );
            $mailer->send($message);
        
                
            return $this->redirectToRoute('app_login');
        }
        return $this->render('register/index.html.twig', [
            'registrationForm' => $form->createView()
        ]);
    }


    #[Route('/activation/{token}', name: 'activation')]
    public function activation($token, UserRepository $userRepository, EntityManagerInterface $entityManagerInterface)
    {
        $user = $userRepository->findOneBy(['token' => $token]);
        if (!$user) {
            throw $this->createNotFoundException('cet utilisateur nexiste pas');
        }
       
        $entityManagerInterface->persist($user);
        $entityManagerInterface->flush();
        $this->addFlash('info', "Vous avez bien activée votre compte");

        return $this->redirectToRoute('app_login');
    }

    #[Route('/oubli-pass', name: 'app_forgotten_Password')]
    public function oublipass(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManagerInterface, TokenGeneratorInterface $tokenGenerator, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ResetTokenType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $donnees = $form->getData();

            $user = $userRepository->findOneByEmail($donnees['email']);
            if ($user === null) {
                $this->addFlash('danger', "cet utilisateur nexiste pas");
                $this->redirectToRoute('app_login');
            }
            $token = $tokenGenerator->generateToken();

            try {
                $user->setResetToken($token);
                $entityManagerInterface =$this->getDoctrine()->getManager();
                $entityManagerInterface->persist($user);
                $entityManagerInterface->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', 'une erreur est survenue :'. $e->getMessage());
                $this->redirectToRoute('app_login');
            }
            //On génère l'Url de réinstallisation de mot de passe
            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            //on envoie le message
            $message = (new \Swift_Message('Mot de passe oublié'))
                 ->setFrom('bandamapascale@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    "<p>Bonjour , </p> <p>Une demande de réinitallisation de mot de passe a été effectué sur le site Afik-Visuel;
                    Veuillez cliquez sur le lien suivant " . $url . '</p>'
                ,'text/html'
                );
            $mailer->send($message);

            //on crée le message flash

            $this->addFlash('message', 'un mail de réinitialisation de mot de passe vous a été envoyé par mail');
            return $this->redirectToRoute('app_reset_password');
        }
        return $this->render('security/Motdepasse_oublie.html.twig', ['emailForm' => $form->createView()]);
    }


    

    #[Route('/reset-pass/{token}', name: 'app_reset_password')]
    public function reset_password($token,Request $request, UserPasswordEncoderInterface $PasswordEncoder)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['token'=>$token]);
        if($user === null){
            $this->addFlash('danger','token inconnu');
            $this->redirectToRoute('app_login');
        }
        if ($request->isMethod('POST')) {
            // On supprime le token
            $user->setResetToken(null);
    
            // On chiffre le mot de passe
            $user->setPassword($PasswordEncoder->encodePassword($user, $request->request->get('password')));

            $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // On crée le message flash
        $this->addFlash('message', 'Mot de passe mis à jour');

        // On redirige vers la page de connexion
        return $this->redirectToRoute('app_login');
    }else {
        // Si on n'a pas reçu les données, on affiche le formulaire
        return $this->render('security/reset_form.html.twig', ['token' => $token]);
    }
    }
}
