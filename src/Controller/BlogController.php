<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Blog;
use App\Form\BlogType;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
    
    public function newBlog(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $form = $this->createForm(BlogType::class, $article);
        
        //FORM TREATMENT
        $form->handleRequest($request);
        
        foreach($article as $blog){
            $entityManager->persist($article);
            $entityManager->flush();
            return $this->render('blog/index.html.twig');
        }
        
        return $this->render('blog/index.html.twig', [
            'formBlog' => $form->createView()
            ]);
    }
}
