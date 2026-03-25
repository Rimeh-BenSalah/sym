<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class Blog2Controller extends AbstractController
{
    #[Route('/blog2', name: 'app_blog3')]
    public function index(): Response
    {
        return $this->render('blog2/index.html.twig');
    }



    #[Route('/add/{url}', name: 'app_add')]
    public function add($url):Response{
       // return new Response('<h1>ajouter un article</h1>');
       return $this->render('blog2/add.html.twig',['slug'=>$url]);
    }
    #[Route('/show/{url}', name: 'app_blog2')]
    public function show($url):Response{
        //return new Response('<h1>lire l\'article'.$url.'</h1>');
        return $this->render('blog2/show.html.twig',['slug'=>$url]);
    }
    #[Route('/edit/{url}', name: 'app_blog2')]
    public function edit($url):Response{
        //return new Response('<h1>modifier l\'article'.$id.'</h1>');
        return $this->render('blog2/edit.html.twig',['slug'=>$url]);
    }
    public function remove($id){
        return new Response('<h1>supprimer l\'article'.$id.'</h1>');
    }
}
