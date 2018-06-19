<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Contact;

class HomeController extends Controller
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
/* *********** WITH URL /(NOTHING), THE TWIG home/home.html.twig IS DISPLAYED */
    /**
     * @Route("/", name="home")
     */ 
    
    public function home(){
        return $this->render('home/home.html.twig'); // render allows to call for the twig file
    }
    
    
    /**
     * @Route("/contact", name="contact")
     */
    public function newContact(Request $request, ObjectManager $manager){
        
        $contact = new Contact();
        // createFormBuilder() creates a form linked to $contact
        $form = $this->createFormBuilder($contact)
        // now let's configurate the form ! 
                    ->add('prenom')
                    ->add('nom')
                    ->add('email')
                    ->add('message')
                    ->getForm();
        
        return $this->render('home/contact.html.twig');
        
    }
}
