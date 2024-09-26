<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
//defines the "home" controller 
class HomeController extends AbstractController
{   
 //Sets the route for home page  
    #[Route('/', name:'app_home')]
 //allows the display of the home page      
 public function index():Response{
    return $this->render('home/home.html.twig');
 }
 //Sets the route for contacts page
    #[Route('/contact', name:'app_contact')]
 //allows the display of the contacts page    
public function contact():Response{
    return $this->render('home/contact.html.twig');
}
}
