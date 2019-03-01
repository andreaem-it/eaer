<?php

namespace App\Controller;


use App\Entity\Categories;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('FrontEnd/Blog/blog.html.twig', [
            'post_list' => $this->getDoctrine()->getRepository(Post::class)->findAll(),
            'category_list' => $this->getDoctrine()->getRepository(Categories::class)->findAll()
        ]);
    }

    /**
     * @Route("/blog/article/{year}/{month}/{slug}", name="blog_article")
     */
    public function show($slug){
        return $this->render('FrontEnd/Blog/article.html.twig', [
            'post' => $this->getDoctrine()->getRepository(Post::class)->findBy(['slug' => $slug]),
            'category_list' => $this->getDoctrine()->getRepository(Categories::class)->findBy([],['name'=> 'ASC']),
//            'previous' => $this->getDoctrine()->getRepository(Post::class)->findOneBy(['id' => $id - 1]),
//            'next' => $this->getDoctrine()->getRepository(Post::class)->findOneBy(['id' => $id + 1]),
        'previous' => [],
            'next' => []
        ]);
    }

    /**
     * @Route("/blog/category/{id}", name="blog_category")
     */
    public function categories($id) {

    }
}
