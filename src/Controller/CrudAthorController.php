<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/crud/author')]
class CrudAthorController extends AbstractController
{
    #[Route('/list', name: 'app_crud_author')]
    public function list(AuthorRepository $repository): Response
    {

        $list = $repository->findAll();
        return $this->render('crud_author/list.html.twig', ['list' => $list]);
    }

    //find by name
    #[Route('/search/{name}', name: 'app_crud_search')]
    public function search(AuthorRepository $repository, Request $request): Response
    {
        $name = $request->get('name');
        $author = $repository->findByName($name);
        //var_dump($author);die();
        //var_dump($name);die();
        return $this->render('crud_author/list.html.twig', ['list' => $author]);
    }
    //insert author
    #[Route('/new', name: 'app_crud_search')]
    public function add(ManagerRegistry $doctrine): Response
    {
        $author = new Author;
        $author->setName('Ahmed');
        $author->setEmail('Ahmed@gmail.com');
        $author->setAddress('address 3');
        $author->setNbrBooks('10');
        //presist the object in the doctrine
        $em = $doctrine->getManager();
        $em->persist($author);
        $em->flush();
        return $this->redirectToRoute('app_crud_author');
    }
    //delete author
    #[Route('/delete/{id}', name: 'app_delete_author')]
    public function deleteAuthor(Author $author, ManagerRegistry $doctrine): Response
    {

        $em = $doctrine->getManager();
        $em->remove($author);
        $em->flush();
        return $this->redirectToRoute('app_crud_author');
    }

    #[Route('/update/{id}', name: 'app_crud_update')]
    public function update(ManagerRegistry $doctrine, AuthorRepository $repository, Request $request): Response
    {
        $id = $request->get('id');
        $author = $repository->find($id);
        $author->setName('Ahmed');
        $author->setEmail('Ahmed@gmail.com');
        $author->setAddress('address 3');
        $author->setNbrBooks('10');
        //presist the object in the doctrine
        $em = $doctrine->getManager();
        $em->flush();
        return $this->redirectToRoute('app_crud_author');
    }
}
