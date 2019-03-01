<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontEndController extends AbstractController
{
    /**
     * @Route("/", name="front_end")
     */
    public function index()
    {
        return $this->render('FrontEnd/index.html.twig', [
            'post_list' => $this->getDoctrine()->getRepository(Post::class)->findBy([],['datetime' => 'DESC'],3),
        ]);
    }
}
