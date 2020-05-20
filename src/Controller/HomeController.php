<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/login", name="homepage")
     */

    public function index()
    {
        return $this->render('home/index.html.twig');
    }

     /**
     * @Route("/profile", name="app_profil")
     */
    public function profil(){
        $this->getUser();
        return $this->render('home/profil.html.twig');
    }
}
