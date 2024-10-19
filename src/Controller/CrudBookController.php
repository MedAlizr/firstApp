<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/crud/book')]
class CrudBookController extends AbstractController
{
    #[Route('/new', name: 'app_new_book')]
    public function newBook(ManagerRegistry $doctrine, Request $request): Response
    {

        //create instance of book
        $book = new Book();
        //create interface
        $form = $this->createForm(BookType::class, $book);
        //send interface to user
        return $this->render('crud_book/form.html.twig', ['form' => $form->createView()]);
        //handle the request
        $form = $form->handleRequest($request);

        //check if the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            //get data from form
            $entityManager = $doctrine->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            //redirect 
            return $this->redirectToRoute('app_book_list');
        }

        return $this->redirectToRoute('app_book_list');
    }
}
