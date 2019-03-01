<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
        ]);
    }

    /**
     * @Route("/admin/articles/list", name="admin_articles_list")
     */
    public function articleList() {

        return $this->render("admin/articles/list.html.twig", [
            'posts' => $this->getDoctrine()->getRepository(Post::class)->findAll()
        ]);
    }

    /**
     * @Route("/admin/articles/new", name="admin_articles_new")
     */
    public function articleNew() {

        return $this->render("", [

        ]);
    }

    /**
     * @Route("/admin/articles/categories", name="admin_articles_categories")
     */
    public function articleCategories() {

        return $this->render("", [

        ]);
    }
}
