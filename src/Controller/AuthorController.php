<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/author')]
class AuthorController extends AbstractController
{
    #[Route('/show',name:'app_author_show')]
   public function displayAutor():Response{
    $authorName='Victor hugo';
    $authorEmail='V.hugo@outlook.com';
    return $this ->render('author/showAuthor.html.twig',array('authorName'=>$authorName,'authorEmail'=>$authorEmail));
   }
   #[Route('/list',name:'app_author_list')]
   public function listAuthors():Response{
    $authorList=[
        ["authorName"=>"Victor Hugo","picture"=>'images/im1.jpg',"nbrBooks"=>44],
        ["authorName"=>"William S","picture"=>'images/im2.jpg',"nbrBooks"=>51],
        ["authorName"=>"taha hsin","picture"=>'images/im3.jpg',"nbrBooks"=>60]
        
    ];
    return $this->render('author/listAuthors.html.twig',array('authorList'=>$authorList));
   }
}
