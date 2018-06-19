<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
    public function newContact(Request $request, EntityManagerInterface $EntityManagerInterface){
        
        $contact = new Contact(); // $contact is an empty contact object, ready to be completed
        // createFormBuilder() creates a form binded to $contact
        $form = $this->createFormBuilder($contact) // here $contact is the entity
        // now let's configurate the form ! 
                    ->add('prenom', textType::class, [
                        'attr' => ['placeholder' => 'Votre prénom'
                        ]])
                    ->add('nom', textType::class, [
                        'attr' => ['placeholder' => 'Votre nom'
                        ]])
                    ->add('email', EmailType::class, [
                        'attr' => ['placeholder' => 'Votre email'
                        ]])
                    ->add('message', textType::class, [
                        'attr' => ['placeholder' => 'Quel est votre projet ?'
                        ]])
                    ->getForm();
        // now I want to display the form via twig
        
        
        return $this->render('home/contact.html.twig',[
            'formContact' => $form->createView()    
            // createView() is a method from the FORM CLASS to make the displaing
            ]);
        
    }
}
