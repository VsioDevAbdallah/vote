<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\User;
use App\Form\CompanyType;
use App\Form\RegistrationFormType;
use App\Form\RegistrationType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;


class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator): Response
    {


        $email = $request->request->get('email_user');
        
        $user = $this->getDoctrine()->getRepository(User::class)->findOneByEmail($email);

        if(null != $user){
            $plainPassword = $this->randomPassword();
            dump($plainPassword);
            
            $encoded = $passwordEncoder->encodePassword(
                $user,
                $plainPassword);
    
            $user->setPassword($encoded);

            /*$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();*/
        }else{
            $this->addFlash('Erreur', "Erreur lors de l'ajout du contact");
            return $this->redirectToRoute('app_login');
        }
       
        //$form = $this->createForm(ResetType::class, $user);

        /*$form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();*/

            /*return $guardHandler->authenticateUserAndHandleSuccess(
                $user,  // the User object you just created
                $request,
                $authenticator, // authenticator whose onAuthenticationSuccess you want to use
                'main'   // the name of your firewall in security.yaml
            );*/
        //}

        

        /*return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);*/
        
    }

    function randomPassword( $length = 8 ) 
    { 
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?"; 
        $length = rand(10, 16); 
        $password = substr( str_shuffle(sha1(rand() . time()) . $chars ), 0, $length );
        return $password;
    }
}
