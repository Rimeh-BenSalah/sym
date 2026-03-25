<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index():Response{
        return $this->render('blog/ind.html.twig');
    }
    public function add(){
        return new Response('<h1>ajouter un article</h1>');
    }
     #[Route('/show/{url}', name: 'app_blog')]
    public function show($url):Response{
        //return new Response('<h1>lire l\'article'.$url.'</h1>');
        return $this->render('blog/show.html.twig',['slug'=>$url]);
    }
    public function edit($id){
        return new Response('<h1>modifier l\'article'.$id.'</h1>');
    }
    public function remove($id){
        return new Response('<h1>supprimer l\'article'.$id.'</h1>');
    }
}
