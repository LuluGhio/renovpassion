<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
/* *********** WITH URL /(NOTHING), THE TWIG home/home.html.twig IS DISPLAYED */
    /**
     * @Route("/", name="home")
     */ 
    
    public function home(){
        return $this->render('home/home.html.twig');
    }
}
