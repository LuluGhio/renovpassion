<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;
// use Symfony\Component\Form\Extension\Core\Type\EmailType;
// use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


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
    public function newContact(Request $request, EntityManagerInterface $entityManager): Response{
        
        $entityManager = $this->getDoctrine()->getManager();
        
        $contact = new Contact(); // $contact is an empty contact object, ready to be completed
        // createFormBuilder() creates a form binded to $contact
        $form = $this->createFormBuilder($contact) // here $contact is the entity
        // BUILDING THE FORM
                    ->add('prenom')
                    ->add('nom')
                    ->add('email')
                    ->add('message')
                    ->add('enregistrer', SubmitType::class, [
                        'label' => "Envoyer"
                        ]
                    )
                    ->getForm();
        // now I want to display the form via twig
        
        //FORM TREATMENT
        $form->handleRequest($request); // analysing the request: submitted or not
        
        if($form->isSubmitted() && $form->isValid()){
            //saving the query
            $entityManager->persist($contact);
            // executes the query
            $entityManager->flush();
            return $this->render('home/merci.html.twig');
        }
        
        return $this->render('home/contact.html.twig',[
            'formContact' => $form->createView()    
            // createView() is a method from the FORM CLASS to make the displaying
            ]);
    }
}
